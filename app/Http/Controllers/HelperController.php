<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HelperController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('foto');

        // Mendapatkan informasi waktu saat ini
        $dateTime = date('YmdHis');

        // Menggabungkan informasi waktu dengan ekstensi file asli
        $fileName = $dateTime . '.' . $file->getClientOriginalExtension();

        // Menyimpan file ke direktori public/images dengan nama baru
        $path = $file->storeAs('assets/photos', $fileName);

        return [
            'path_foto' => $path ?? '',
            'name_foto' => $fileName ?? ''
        ];
    }
}
