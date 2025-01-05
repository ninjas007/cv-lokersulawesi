@extends('layouts.lowongan')

@section('meta')
    <meta name="description"
        content="Loker Sulawesi adalah website yang menyediakan lowongan kerja untuk wilayah indonesia bagian Sulawesi">
    <meta name="keywords" content="Loker Sulawesi, lowongan kerja Sulawesi, Sulawesi, sulawesi selatan, sulawesi barat">

    <title>LOKER SULAWESI - ABOUT</title>
@endsection

@section('css')
    @include('jobs.style')
    <style>
        .body-wrap {
            min-height: 100vh;
            /* Ensure it takes the full height of the viewport */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            text-align: center;
            padding: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="body-wrap">
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div>

                        <img src="{{ asset('assets/photos/lokersulawesi-192x192.jpeg') }}" alt="Loker Sulawesi Logo"
                            class="img-fluid" width="100px">
                        <div class="text-info h4 bold mt-2">Loker Sulawesi</div>
                        <br>
                        Loker Sulawesi merupakan website yang menghubungkan antara pemberi dan pencari kerja untuk
                        wilayah indonesia
                        bagian Sulawesi dan sekitarnya.
                        <br> <br>
                        Lowongan kerja yang terdapat pada website ini merupakan lowongan yang di post oleh perusahaan
                        dan juga admin
                        dari Loker Sulawesi. Lowongan juga sudah di filter oleh admin agar lowongan betul dan sesuai
                        agar tidak terjadi
                        penipuan. Mohon untuk tidak percaya kepada lowongan yang mensyaratkan biaya. Hati-hati dalam
                        melamar pekerjaan,
                        segala bentuk penipuan dari pencari atau pemberi kerja pihak Loker Sulawesi tidak ikut
                        bertanggung jawab.
                        <br> <br>
                        Kami berharap website ini dapat memberikan informasi yang bermanfaat dan mempermudah para
                        pencari kerja.
                        <br>
                        Apabila ada saran atau kritik silahkan menghubungi <a href="https://wa.me/6282389097065"
                            target="_blank">Whatsapp</a>

                        <br>
                        <br>
                        <div>Copyright @ {{ date('Y') }} Developed by <a href="https://ninjas007.github.io"
                                target="_blank">Tilis
                                Tiadi</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
