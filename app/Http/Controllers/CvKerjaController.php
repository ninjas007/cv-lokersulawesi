<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CvKerjaController extends Controller
{
    public function index()
    {
        $data['menu'] = 'home';
        $data['templates'] = [
            [
                'id' => 1,
                'image' => "assets/images/test.jpg",
                'nama' => 'Template 1'
            ],
            [
                'id' => 2,
                'image' => "assets/images/test.jpg",
                'nama' => 'Template 2'
            ]
        ];

        return view('pages.cv-kerja', $data);
    }

    public function preview(Request $request)
    {
        $data['data'] = $request->all();

    
        // return view('menus.preview', $data);
        $pdf = Pdf::loadView('menus.preview', $data);
        return $pdf->stream('invoice.pdf', ['Attachment' => false]);

    }
}
