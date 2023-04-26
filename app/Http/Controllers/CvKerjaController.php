<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvKerjaController extends Controller
{
    public function index()
    {
        $data['menu'] = 'home';

        return view('pages.cv-kerja', $data);
    }
}
