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
        .wizard,
        .wizard .nav-tabs,
        .wizard .nav-tabs .nav-item {
            position: relative;
        }

        /* .wizard .nav-tabs:after {
                                content: "";
                                width: 80%;
                                border-bottom: solid 2px #54b4d3;
                                position: absolute;
                                margin-left: auto;
                                margin-right: auto;
                                top: 38%;
                                z-index: -1;
                            } */

        .wizard .nav-tabs .nav-item .nav-link {
            width: 10px !important;
            height: 10px !important;
            background: white;
            border: 1px solid #ccc;
            color: #ccc;
            z-index: 10;
        }

        .nav-tabs .nav-link {
            --mdb-nav-tabs-link-font-size: 11px;
            --mdb-nav-tabs-link-color: rgba(0, 0, 0, 0.55);
            --mdb-nav-tabs-link-padding-top: 15px !important;
            --mdb-nav-tabs-link-padding-bottom: 15px !important;
            --mdb-nav-tabs-link-padding-x: 17px !important;
            --mdb-nav-tabs-link-hover-bgc: #f7f7f7;
            --mdb-nav-tabs-link-border-bottom-width: 2px;
            --mdb-nav-tabs-link-active-color: #333333;
            --mdb-nav-tabs-link-active-border-color: #333333;
            font-size: var(--mdb-nav-tabs-link-font-size);
            color: var(--mdb-nav-tabs-link-color);
            padding: var(--mdb-nav-tabs-link-padding-top) var(--mdb-nav-tabs-link-padding-x) var(--mdb-nav-tabs-link-padding-bottom) var(--mdb-nav-tabs-link-padding-x);
        }

        .wizard .nav-tabs .nav-item .nav-link:hover {
            color: #54b4d3;
            border: 2px solid #54b4d3;
        }

        .wizard .nav-tabs .nav-item .nav-link.active {
            background: #fff;
            border: 2px solid #54b4d3;
            color: #54b4d3;
        }

        .card {
            box-shadow: none !important;
        }

        .wizard .nav-tabs .nav-item .nav-link:after {
            content: " ";
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #333333;
            transition: 0.1s ease-in-out;
        }

        .fixed-bottom-container {
            position: fixed;
            bottom: 55px;
            padding: 10px;
            width: var(--width-page);
            z-index: 100;
            background: white;
            border-top: #e3e3e3 1px solid;
        }

        .fixed-top-container {
            position: fixed;
            top: 0px;
            padding: 10px;
            width: var(--width-page);
            z-index: 100;
            background: white;
            border-bottom: 2px solid #f5f5f5;
        }

        @media (max-width: 540px) {

            .fixed-top-container,
            .fixed-bottom-container {
                width: 100% !important;
            }

            #myTabContent {
                margin-top: 20px !important;
            }
        }
    </style>
@endsection

@section('content')
    <section class="mt-3">
        <div class="container">
            <div class="wizard fixed-top-container">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    @php
                        $contents = [
                            [
                                'id' => 1,
                                'icon' => 'fas fa-user',
                                'title' => 'Data Diri',
                                'blade' => 'data-diri',
                            ],
                            [
                                'id' => 2,
                                'icon' => 'fas fa-briefcase',
                                'title' => 'Pendidikan',
                                'blade' => 'pendidikan',
                            ],
                            [
                                'id' => 3,
                                'icon' => 'fas fa-share-alt',
                                'title' => 'Sosial Media',
                                'blade' => 'sosial',
                            ],
                            [
                                'id' => 4,
                                'icon' => 'fas fa-briefcase',
                                'title' => 'Pengalaman Kerja',
                                'blade' => 'pengalaman',
                            ],
                            [
                                'id' => 5,
                                'icon' => 'fas fa-lightbulb',
                                'title' => 'Keahlian',
                                'blade' => 'keahlian',
                            ],
                            [
                                'id' => 6,
                                'icon' => 'fas fa-star',
                                'title' => 'Portofolio',
                                'blade' => 'portofolio',
                            ],
                        ];
                    @endphp

                    @include('pages.parts.nav-tabs', ['steps' => $contents])
                </ul>
            </div>
            <form method="POST" action="{{ url('preview') }}" enctype="multipart/form-data" id="formCvKerja">
                @csrf
                <input type="hidden" id="snapToken" name="snap_token">
                <input type="hidden" id="responseVal" name="responseVal">
                <div class="wizard" style="padding-bottom: 50px;">
                    <div class="tab-content mt-4 py-2" id="myTabContent">
                        @foreach ($contents as $content)
                            <div class="tab-pane fade {{ $content['id'] == 1 ? 'show active' : '' }}" role="tabpanel"
                                id="step{{ $content['id'] }}" aria-labelledby="step{{ $content['id'] }}-tab">
                                @include('pages.parts.cv-kerja.' . $content['blade'], $content)
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>

        </div>
    </section>

    @include('pages.modals.modal-pilih-template')

    @include('pages.modals.modal-login')

    @if (auth()->check())
        @include('pages.modals.modal-akun')
    @endif

@endsection

@section('js')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js'></script>
    <script src="https://cdn.tiny.cloud/1/fioab1f7iscuty6onrm6ezlq795cnlvwjy81btkvag3piuoj/tinymce/6/tinymce.min.js">
    </script>

    @include('js.tabs')

    @include('js.cv-kerja')
@endSection
