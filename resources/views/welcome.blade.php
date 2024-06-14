<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CV Generate Loker Sulawesi</title>
    <meta name="description"
        content="Buat CV Profesional dengan Mudah di Lokersulawesi.com | Tingkatkan Peluang Karirmu di Sulawesi.
    Lokersulawesi.com menyediakan CV Maker terpercaya yang memungkinkanmu membuat CV menarik dan profesional secara cepat.
    Dengan berbagai template modern dan pilihan kustomisasi yang luas, buat CV yang mencerminkan kepribadianmu dan sesuai
    dengan kebutuhan perekrut di Sulawesi. Tingkatkan peluangmu dalam mencari pekerjaan impian dengan CV yang menonjol dari
    CV Maker Lokersulawesi.com. Dapatkan keunggulan di pasar kerja Sulawesi dengan alat CV terbaik kami.">
    <meta name="keywords"
        content="CV maker, CV profesional, lowongan kerja, peluang karir, Sulawesi, pencari kerja, CV menarik, CV
    kreatif, CV online, template CV, alat CV, Lokersulawesi.com">

    <meta property="og:title" content="Cv Generator - Loker Sulawesi">
    <meta property="og:description"
        content="Buat CV Profesional dengan Mudah di Lokersulawesi.com | Tingkatkan Peluang Karirmu di Sulawesi.
    Lokersulawesi.com menyediakan CV Maker terpercaya yang memungkinkanmu membuat CV menarik dan profesional secara cepat.
    Dengan berbagai template modern dan pilihan kustomisasi yang luas, buat CV yang mencerminkan kepribadianmu dan sesuai
    dengan kebutuhan perekrut di Sulawesi. Tingkatkan peluangmu dalam mencari pekerjaan impian dengan CV yang menonjol dari
    CV Maker Lokersulawesi.com. Dapatkan keunggulan di pasar kerja Sulawesi dengan alat CV terbaik kami.">
    <meta property="og:image" content="{{ asset('assets/photos/lokersulawesi.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="https://cv.lokersulawesi.com">

    <link rel="icon" href="{{ asset('assets/photos/lokersulawesi-32x32.jpeg') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('assets/photos/lokersulawesi-192x192.jpeg') }}" sizes="192x192" />

    <!-- Styles -->
    <style>
        html {
            background-color: #0000;
            color: #636b6f;
            margin: 0;
        }

        body {
            background-image: url('{{ asset('assets/images/background2.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #0000;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3">
                        <div class="col text-center">
                            <div class="h1 font-weight-bold">Buat Surat</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col mb-3">
                            <a href="{{ url('cv-kerja') }}" target="_blank" class="btn btn-success p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/cv.png') }}">
                                </div>
                                <div>
                                    CV Pribadi
                                </div>
                            </a>
                        </div>
                        <div class="col mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')" target="_blank" class="btn btn-success p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/kerja.png') }}">
                                </div>
                                <div>
                                    Lamaran Kerja
                                </div>
                            </a>
                        </div>
                        <div class="col mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')" target="_blank" class="btn btn-success p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/sakit.png') }}">
                                </div>
                                <div>
                                    Surat Sakit
                                </div>
                            </a>
                        </div>
                        <div class="col mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')" target="_blank" class="btn btn-success p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/taaruf.png') }}">
                                </div>
                                <div>
                                    CV Ta'aruf
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ url('auth/google') }}" target="_blank" class="btn btn-success text-white">
                                <i class="fa fa-sign-in"></i> Login Google
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
