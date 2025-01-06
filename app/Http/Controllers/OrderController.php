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
            // have orderId request
            $order = Order::where('number', $request->order_id)
                    ->where('payment_status', 2)
                    ->where('limit_edit', '>', 0)
                    ->first();

            // new order
            if ($order) {
                $snapToken = $order->snap_token;
                $order->limit_edit -= 1;

                $redirect = 'history?order_id='.$request->order_id;
            } else {
                $resultCreate = $this->createNewOrder($request);
                $resMidtrans = $this->createTrxMidtrans($resultCreate);
                $order = $resMidtrans['order'];
                $snapToken = $resMidtrans['snap_token'];

                $redirect = 'order/checkout?order_id='.$order->number.'&snap_token='.$snapToken.'';
            }

            // save payload if new or update
            $order->payload = json_encode($request->all());
            $order->template_use = $request->template_use;

            // update user id in table order if login
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $order->user_id = $userId;
            }

            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return redirect($redirect);
        } catch (\Exception $e) {

            DB::rollBack();

            if (config('app.debug')) {
                dd($e->getMessage());
            }

            return redirect()->back()->with(['error' => 'Terjadi kesalahan server. coba lagi atau hubungi admin']);
        }
    }

    private function createTrxMidtrans(array $result): array
    {
        $order = $result['order'];

        // dummy, untuk develop makanya pakai ini
        $snapToken = 'd520fe0d-89d5-428d-a9e9-f58017d06fd7';
        $order->payment_status = 2;

        if (config('midtrans.is_active')) {
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken($result['item_details'	], $result['customer_details']);
            $order->payment_status = 1;
        }

        return [
            'order' => $order,
            'snap_token' => $snapToken
        ];
    }

    private function requestBodyMidtrans($request): array
    {
        $latestIdOrder = Order::count() + 1;
        $price = app(SeedController::class)->templateHarga($request->template_use);

        // midtrans
        $itemDetails = [
            [
                'id' => $latestIdOrder,
                'price' => 10000,
                'quantity' => 1,
                'name' => 'Order CV Kerja',
            ],
        ];

        $customerDetails = [
            'first_name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->no_hp,
        ];

        return [
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
            'price' => 10000,
            'latest_order_id' => $latestIdOrder
        ];
    }

    private function createNewOrder($request): array
    {
        $requestBodyMidtrans = $this->requestBodyMidtrans($request);
        $itemDetails = $requestBodyMidtrans['item_details'];
        $customerDetails = $requestBodyMidtrans['customer_details'];
        $price = $requestBodyMidtrans['price'];
        $latestIdOrder = $requestBodyMidtrans['latest_order_id'];

        $dateNow = date('ymdhis');
        $number = 'KRJ-'.$dateNow.substr(md5(rand(1000, 9999)), 0, 5).sprintf('%04d', $latestIdOrder);

        $order = new Order;
        $order->number = $number;
        $order->total_price = $price;
        $order->item_details = json_encode($itemDetails);
        $order->customer_details = json_encode($customerDetails);

        return [
            'order' => $order,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails
        ];
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
