@extends('layouts.app')

@section('description',
    'Buat CV Profesional dengan Mudah di Lokersulawesi.com | Tingkatkan Peluang Karirmu di Sulawesi.
    Lokersulawesi.com menyediakan CV Maker terpercaya yang memungkinkanmu membuat CV menarik dan profesional secara cepat.
    Dengan berbagai template modern dan pilihan kustomisasi yang luas, buat CV yang mencerminkan kepribadianmu dan sesuai
    dengan kebutuhan perekrut di Sulawesi. Tingkatkan peluangmu dalam mencari pekerjaan impian dengan CV yang menonjol dari
    CV Maker Lokersulawesi.com. Dapatkan keunggulan di pasar kerja Sulawesi dengan alat CV terbaik kami.')
@section('keywords',
    'CV maker, CV profesional, lowongan kerja, peluang karir, Sulawesi, pencari kerja, CV menarik, CV
    kreatif, CV online, template CV, alat CV, Lokersulawesi.com')


@section('css')
    <style>
        /* make wrapper height dfeault */
        #wrapper {
            height: auto !important;
        }

        .body-wrap {
            min-height: 100vh !important;
        }
    </style>
@endsection

@section('content')
    <section class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="box-shadow: none">
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="keyword" class="mb-1">Masukkan Order ID</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="Contoh: KRJ-24060803232523032" name="order_id"
                                            value="{{ request('order_id') ?? '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary text-white"
                                                id="basic-addon2">
                                                <i class="fa fa-search"></i>&nbsp;CARI
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-3" style="box-shadow: none; border: 1px solid #d5d5d5">
                        <div class="card-body">
                            @if (request('order_id'))
                                @if ($order)
                                    @include('pages.history.detail')
                                @else
                                    <div class="text-center">
                                        <div class="h5">
                                            Order ID <b class="text-info">{{ request('order_id') }}</b> tidak ditemukan <br>
                                            silahkan periksa kembali
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="text-center">
                                    <div class="h5">
                                        Silahkan cari history berdasarkan order ID
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@php
    $payload = $order->payload ?? '';
@endphp

@section('js')
    @include('js.copy')

    @if ($order)
        @include('js.midtrans', [
            'snapToken' => $order->snap_token ?? '',
            'order' => $order ?? '',
        ])
    @endif

    <script>
        function loadDataForm(orderId) {
            let data = `{!! $payload !!}`;
            swal({
                    title: 'Yakin untuk mereload form?',
                    text: `Data form yang sekarang akan digantikan oleh data dengan order id ${orderId}`,
                    icon: 'warning',
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // clear localstorage key data
                        localStorage.removeItem('data');
                        localStorage.removeItem('foto');

                        // set localstorage key data
                        localStorage.setItem('data', data);

                        // back to cv-kerja url
                        setTimeout(() => {
                            window.location.href = "{{ url('cv-kerja') }}?order_id=" + orderId;
                        }, 500);
                    }
                });
        }

        function copyId(orderId) {
            copyToClipboard(orderId) // get from js.copy
        }
    </script>
@endSection
