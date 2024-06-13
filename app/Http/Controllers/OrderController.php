<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $messages = [
            'ringkasan_profile.required' => 'Ringkasan profil harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'email.required' => 'Email harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi.',
            'foto.required' => 'Gambar harus diunggah.',
            'foto.image' => 'Gambar harus berupa file gambar.',
            'foto.max' => 'Ukuran gambar harus kurang dari 1024KB.',
        ];

        $request->validate([
            'ringkasan_profil' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat_lengkap' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ], $messages);

        $foto = app(\App\Http\Controllers\HelperController::class)->uploadFile($request);
        $request->merge(['path_foto' => $foto['path_foto']]);
        $request->merge(['name_foto' => $foto['name_foto']]);

        DB::beginTransaction();
        try {
            $latestIdOrder = Order::count() + 1;
            $dateNow = date('ymdhis');
            $price = app(SeedController::class)->templateHarga($request->template_use);

            $item_details = [
                [
                    'id' => $latestIdOrder,
                    'price' => $price,
                    'quantity' => 1,
                    'name' => 'Order CV Kerja',
                ],
            ];
            $customer_details = [
                'first_name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
            ];

            $number = 'KRJ-'.$dateNow.substr(md5(rand(1000, 9999)), 0, 5).sprintf('%04d', $latestIdOrder);

            $order = new Order;
            $order->number = $number;
            $order->total_price = $price;
            $order->item_details = json_encode($item_details);
            $order->customer_details = json_encode($customer_details);
            $order->payload = json_encode($request->all());
            $order->template_use = $request->template_use;

            // TODO: check template use berbayar atau tidak
            // kalau berbayar tambah biayanya
            if (config('midtrans.is_active')) {
                $midtrans = new CreateSnapTokenService($order);
                $snapToken = $midtrans->getSnapToken($item_details, $customer_details);
                $order->payment_status = 1;
            } else {
                $snapToken = 'd520fe0d-89d5-428d-a9e9-f58017d06fd7'; // dummy, untuk develop makanya pakai ini
                $order->payment_status = 2;
            }

            if (auth()->check()) {
                $userId = auth()->user()->id;
                $order->user_id = $userId;

                // $user = User::where('id', $userId)->first();
                // $user->raw_detail = json_encode($request->all());
                // $user->save();
            }

            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return redirect('order/checkout?order_id='.$order->number.'&snap_token='.$snapToken.'');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['error' => 'Terjadi kesalahan server. coba lagi atau hubungi admin']);
        }
    }

    public function checkout(Request $request)
    {
        $orderId = $request->order_id;
        $snapToken = $request->snap_token;
        $order = Order::where(['number' => $orderId, 'snap_token' => $snapToken])->first();
        $templates = [
            [
                'id' => 1,
                'image' => "assets/images/templates/template-1.jpg",
                'nama' => 'Template 1'
            ],
            [
                'id' => 2,
                'image' => "assets/images/templates/template-2.jpg",
                'nama' => 'Template 2'
            ]
        ];

        if ($order) {
            return view('order.midtrans', compact('order', 'snapToken', 'templates'));
        }

        return abort(404);
    }

    public function download(Request $request)
    {
        $order = Order::where('number', $request->order_id)->first();

        if (!$order) {
            return abort(404);
        }

        if ($order->payment_status == 2) {
            $data['data'] = json_decode($order->payload, true);

            return view('print.cv-kerja.templates.'.$order->template_use.'', $data);
        }

        return redirect('/order/checkout?order_id='.$request->order_id.'&snap_token='.$request->snap_token);
    }

    public function saveData(Request $request)
    {

    }
}
