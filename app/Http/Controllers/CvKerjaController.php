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
        DB::beginTransaction();
        try {
            $latestIdOrder = Order::count() + 1;
            $dateNow = date('ymdhis');

            $item_details = [
                [
                    'id' => $latestIdOrder,
                    'price' => '20000',
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
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken($item_details, $customer_details);
            
            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return redirect('pembayaran?order_id='.$order->number.'&snap_token='.$snapToken.'');
        } catch (\Throwable $th) {

            DB::rollBack();

            dd($th);
        }
    }
}
