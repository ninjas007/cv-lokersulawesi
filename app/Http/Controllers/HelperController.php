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
        $path = $file->storeAs('public/assets/photos', $fileName);

        return [
            'path_foto' => $path ?? '',
            'name_foto' => $fileName ?? ''
        ];
    }

    public function seederEnvDevelopment()
    {
        $jsonString = '{"foto": {}, "nama": "Tilis Tiadi", "email": "tilistiadi03@gmail.com", "no_hp": "082325576616", "_token": "73gPGQPlBeZRnRh6Hz1hxDBujWAqG4YJKNqGVPXU", "keahlian": {"nama_keahlian": [null], "level_keahlian": ["0"]}, "name_foto": "20230527200742.png", "path_foto": "public/assets/photos/20230527200742.png", "pendidikan": {"kota": ["Kendari - Sulawesi Tenggara", "Kendari - Sulawesi Tenggara", "Kendari - Sulawesi Tenggara"], "jurusan": ["-", "-", "-"], "sekolah": ["SD Negeri 2 Baruga", "SMP Negeri 10 Kendari", "SMK Negeri 4 Kendari"], "tahun_masuk": ["2006", "2009", "2011"], "tahun_keluar": ["2009", "2011", "2014"]}, "pengalaman": {"kota": ["Yogyakarta - DI Yogyakarta", "Yogyakarta - DI Yogyakarta", "Surabaya - Jawa Timur"], "posisi": ["Web Developer", "Web Developer", "Web Developer"], "perusahaan": ["Mangrove Corporate", "Kledo.com", "Medify.id"], "bulan_tahun_masuk": ["September 2019", "Juli 2020", "Februari 2021"], "bulan_tahun_keluar": ["Maret 2020", "September 2020", "Desember 2022"], "deskripsi_pekerjaan": ["- Bug fixing\r\n- Penambahan fitur\r\n- Buat aplikasi POS sederhana", "- Bug fix\r\n- Membuat generate invoice", "- Bug fixing\r\n- Penambahan Fitur\r\n- FItur BPJS\r\n- API BPJS Bridging SIRS dan VClaim"]}, "portofolio": {"nama_portofolio": ["Web Lautanikan", "Web Lokersulawesi"], "deskripsi_portofolio": ["- Menggunakan Codeigniter 3\r\n- Menggunakan AJAX, HTML, CSS, Javascript", "website untuk mencari lowongan kerja derah sulawesi\r\n- Menggunakan Codeigniter 3\r\n- Menggunakan AJAX, HTML, CSS, Javascript"]}, "snap_token": null, "responseVal": null, "sosial_media": {"link": ["www.github.com/ninjas007", "www.facebook.com/von_0x56", "www.instagram.com/von_0x56", "wa.me/6282325576616"], "nama": ["Github", "Facebook", "Instagram", "Whatsapp"]}, "tempat_lahir": "Kendari", "template_use": "2", "jenis_kelamin": "Pria", "tanggal_lahir": "1993-04-03", "alamat_lengkap": "Jln. MT. Haryono, Lr. Beringin, Kel. Bende, Kec. Mandonga, Sulawesi Tenggara 93231", "ringkasan_profil": "Nama saya John Doe, Lahir di Kendari pada tanggal 3 April 1998. Saya adalah seorang web developer. Pernah mengerjakan beberapa project freelance baik itu untuk industri atau pemerintahan.", "deskripsi_keahlian": "Github, NestJS, Laravel, PHP, Javascript, NodeJS, Codeigniter, AWS, JQuery, ReactJS, VueJS, HTML, CSS, Bootstrap", "tipe_input_keahlian": "text"}';

        return json_decode($jsonString, true);
    }
}