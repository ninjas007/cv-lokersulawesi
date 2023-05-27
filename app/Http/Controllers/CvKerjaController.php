<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Order;
use Illuminate\Support\Facades\DB;

class CvKerjaController extends Controller
{
    public function index()
    {
        $data['menu'] = 'home';
        $data['templates'] = [
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

        return view('pages.cv-kerja', $data);
    }

    public function preview(Request $request)
    {
        $data['data'] = $request->all();
        $data['preview'] = true;

        // return view('menus.preview.cv-kerja.templates.1');
        // return view('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data)->render();
        $pdf = Pdf::loadView('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data);
        return $pdf->stream('Preview.pdf', ['Attachment' => false]);
    }

    public function downloadPdf(Request $request)
    {
        $order = Order::where('number', $request->order_id)->first();

        if ($order->payment_status == 2) {
            $data['data'] = json_decode($order->payload, true);

            $pdf = Pdf::loadView('menus.preview.cv-kerja.templates.'.$order->template_use.'', $data);
            return $pdf->stream('Curicullum Vitae.pdf', ['Attachment' => false]);  
        }

        // TODO: update ke halaman belum bayar dan tampilkan status ordernya 
        abort(404);
    }


    public function download(Request $request)
    {
        $messages = [
            'ringkasan_profile.required' => 'Ringkasan profil harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus valid.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'alamat_lengkap.required' => 'Alamat lengkap harus diisi.',
            'foto.required' => 'Gambar harus diunggah.',
            'foto.image' => 'Gambar harus berupa file gambar.',
            'foto.max' => 'Ukuran gambar harus kurang dari 512KB.',
        ];

        $request->validate([
            'ringkasan_profil' => 'required',
            'nama' => 'required:email',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat_lengkap' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:512'
        ], $messages);

        $foto = app(\App\Http\Controllers\HelperController::class)->uploadFile($request);
        $request->merge(['path_foto' => $foto['path_foto']]);
        $request->merge(['name_foto' => $foto['name_foto']]);

        DB::beginTransaction();
        try {
            $latestIdOrder = Order::count() + 1;
            $dateNow = date('ymdhis');

            $item_details = [
                [
                    'id' => $latestIdOrder,
                    'price' => $this->templateHarga($request->template_use),
                    'quantity' => 1,
                    'name' => 'Order CV Kerja',
                ],
            ];
            $customer_details = [
                'first_name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->no_hp,
            ];

            $order = new Order;
            $order->number = 'KRJ-'.$dateNow.sprintf('%04d', $latestIdOrder);
            $order->total_price = 20000;
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
            
            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return redirect('pembayaran?order_id='.$order->number.'&snap_token='.$snapToken.'');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with(['error' => true]);
        }
    }

    public function templateHarga($template_id)
    {
        $templates = [
            "1" => "20000",
            "2" => "15000" 
        ];

        return $templates[$template_id] ?? "20000";
    }
}
