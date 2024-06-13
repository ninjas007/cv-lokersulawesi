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

        return view('pages.cv-kerja.index', $data);
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

        // return view('print.cv-kerja.templates.1', $data);
        return view('print.cv-kerja.templates.'.$request->template_use.'', $data);
        // $pdf = Pdf::loadView('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data);
        // return $pdf->stream('Preview.pdf', ['Attachment' => false]);
    }

}
