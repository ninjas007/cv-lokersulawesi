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
            position: relative;
            background-image: url('{{ asset('assets/images/background-welcome.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(8, 213, 134, 0.208);
            /* Adjust the opacity as needed */
            z-index: -1;
        }

        .full-height {
            height: 100vh;
            position: relative;
            z-index: 2;
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
            z-index: 3;
        }

        .content {
            text-align: center;
            z-index: 3;
            position: relative;
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
                            <div class="font-weight-bold text-white" style="font-size: 40px">Buat Surat</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col me-1 mb-3">
                            <a href="{{ url('cv-kerja') }}" target="_blank" class="btn btn-info p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/cv.png') }}">
                                </div>
                                <div>
                                    CV Pribadi
                                </div>
                            </a>
                        </div>
                        <div class="col me-1 mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')"
                                class="btn btn-info p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/kerja.png') }}">
                                </div>
                                <div>
                                    Lamaran Kerja
                                </div>
                            </a>
                        </div>
                        <div class="col me-1 mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')"
                                class="btn btn-info p-3 text-white">
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/icons/sakit.png') }}">
                                </div>
                                <div>
                                    Surat Sakit
                                </div>
                            </a>
                        </div>
                        <div class="col me-1 mb-3">
                            <a href="javascript:void(0)" onclick="return alert('Sedang dalam pengembangan')"
                                class="btn btn-info p-3 text-white">
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
                            <a href="{{ url('auth/google') }}" target="_blank" class="btn btn-info text-white">
                                <i class="fa fa-sign-in"></i> Login Google
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="position: fixed; bottom: 1%; left: 1%; z-index: 99999;">
        <a href="https://wa.me/6282389097065" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="60" height="60" viewBox="0 0 48 48">
                <path fill="#fff"
                    d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z">
                </path>
                <path fill="#fff"
                    d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z">
                </path>
                <path fill="#cfd8dc"
                    d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z">
                </path>
                <path fill="#40c351"
                    d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z">
                </path>
                <path fill="#fff" fill-rule="evenodd"
                    d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</body>

</html>
