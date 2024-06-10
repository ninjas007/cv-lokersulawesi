<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeedController extends Controller
{
    public function templates()
    {
        return [
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
    }

    public function seederEnvDevelopment()
    {
        $jsonString = '{"foto": {}, "nama": "John Doe", "email": "johndoe@gmail.com", "no_hp": "08232323222323", "_token": "73gPGQPlBeZRnRh6Hz1hxDBujWAqG4YJKNqGVPXU", "keahlian": {"nama_keahlian": [null], "level_keahlian": ["0"]}, "name_foto": "default.jpg", "path_foto": "assets/photos/default.jpg", "pendidikan": {"kota": ["Kendari - Sulawesi Tenggara", "Kendari - Sulawesi Tenggara", "Kendari - Sulawesi Tenggara"], "jurusan": ["", "", ""], "sekolah": ["SD Negeri 2 Baruga", "SMP Negeri 10 Kendari", "SMK Negeri 4 Kendari"], "tahun_masuk": ["2006", "2009", "2011"], "tahun_keluar": ["2009", "2011", "2014"]}, "pengalaman": {"kota": ["Yogyakarta - DI Yogyakarta", "Yogyakarta - DI Yogyakarta", "Surabaya - Jawa Timur"], "posisi": ["Web Developer", "Web Developer", "Web Developer"], "perusahaan": ["Mangrove Corporate", "Kledo.com", "Medify.id"], "bulan_tahun_masuk": ["September 2019", "Juli 2020", "Februari 2021"], "bulan_tahun_keluar": ["Maret 2020", "September 2020", "Desember 2022"], "deskripsi_pekerjaan": ["- Bug fixing\r\n- Penambahan fitur\r\n- Buat aplikasi POS sederhana", "- Bug fix\r\n- Membuat generate invoice", "- Bug fixing\r\n- Penambahan Fitur\r\n- FItur BPJS\r\n- API BPJS Bridging SIRS dan VClaim"]}, "portofolio": {"nama_portofolio": ["Web Lautanikan", "Web Lokersulawesi"], "deskripsi_portofolio": ["- Menggunakan Codeigniter 3\r\n- Menggunakan AJAX, HTML, CSS, Javascript", "website untuk mencari lowongan kerja derah sulawesi\r\n- Menggunakan Codeigniter 3\r\n- Menggunakan AJAX, HTML, CSS, Javascript"]}, "snap_token": null, "responseVal": null, "sosial_media": {"link": ["www.github.com/ninjas007", "www.facebook.com/von_0x56", "www.instagram.com/von_0x56", "wa.me/62834343434"], "nama": ["Github", "Facebook", "Instagram", "Whatsapp"]}, "tempat_lahir": "Kendari", "template_use": "1", "lang_use": "1", "jenis_kelamin": "Pria", "tanggal_lahir": "1993-04-03", "alamat_lengkap": "Jln. MT. Haryono, Lr. Beringin, Kel. Bende, Kec. Mandonga, Sulawesi Tenggara 93231", "ringkasan_profil": "Saya adalah seorang Web Developer berpengalaman dengan keahlian dalam pengembangan aplikasi web yang responsif dan dinamis. Dengan latar belakang yang kuat dalam berbagai bahasa pemrograman dan kerangka kerja modern, saya berdedikasi untuk menciptakan solusi web yang inovatif dan user-friendly. Saya memiliki kemampuan analitis yang tajam, perhatian terhadap detail, dan semangat untuk terus belajar dan berkembang dalam bidang teknologi.", "deskripsi_keahlian": "Github, NestJS, Laravel, PHP, Javascript, NodeJS, Codeigniter, AWS, JQuery, ReactJS, VueJS, HTML, CSS, Bootstrap", "tipe_input_keahlian": "text"}';

        return json_decode($jsonString, true);
    }

    public function templateHarga($template_id)
    {
        $templates = [
            "1" => config('midtrans.templates_1'),
            "2" => config('midtrans.templates_1')
        ];

        return $templates[$template_id] ?? "10000";
    }
}
