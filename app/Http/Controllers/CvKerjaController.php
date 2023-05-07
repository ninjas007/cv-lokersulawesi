<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

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

    public function download(Request $request)
    {
        $data['data'] = $request->all();
        
        // TODO: arahkan dulu ke payment gateway
        

        $pdf = Pdf::loadView('menus.preview.cv-kerja.templates.'.$request->template_use.'', $data);
        return $pdf->stream('Curicullum Vitae.pdf', ['Attachment' => false]);
    }
}
