<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SeedController;
use App\User;

class CvKerjaController extends Controller
{
    protected $seeds;

    public function __construct(SeedController $seeds)
    {
        $this->seeds = $seeds;
    }

    public function index()
    {
        $data['menu'] = 'home';
        $data['templates'] = $this->seeds->templates();

        return view('pages.cv-kerja', $data);
    }

    public function preview(Request $request)
    {
        if (config('app.seed_preview')) {
            $content = $this->seeds->seederEnvDevelopment();
        } else {
            $content = $request->all();
        }

        $lang = $request->lang_use ?? 'id';
        app()->setLocale($lang);
        $data = [
            'lang' => $lang,
            'preview' => true,
            'data' => $content
        ];

        // return view('menus.preview.cv-kerja.templates.1', $data);
        return view('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data);
        // $pdf = Pdf::loadView('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data);
        // return $pdf->stream('Preview.pdf', ['Attachment' => false]);
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ], $messages);

        $foto = app(\App\Http\Controllers\HelperController::class)->uploadFile($request);
        $request->merge(['path_foto' => $foto['path_foto']]);
        $request->merge(['name_foto' => $foto['name_foto']]);

        DB::beginTransaction();
        try {
            $latestIdOrder = Order::count() + 1;
            $dateNow = date('ymdhis');
            $price = $this->seeds->templateHarga($request->template_use);

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

            $order = new Order;
            $order->number = 'KRJ-'.$dateNow.sprintf('%04d', $latestIdOrder);
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

                $user = User::where('id', $userId)->first();
                $user->raw_detail = json_encode($request->all());

                $user->save();
            }

            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return redirect('pembayaran?order_id='.$order->number.'&snap_token='.$snapToken.'');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['error' => 'Terjadi kesalahan server. coba lagi atau hubungi admin']);
        }
    }

}
