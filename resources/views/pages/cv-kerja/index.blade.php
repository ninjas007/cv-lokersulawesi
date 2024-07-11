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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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

            .wrap-template {
                margin-bottom: 4.5rem !important;
            }
        }


        /* untuk template saat dipilih */
        .form-check-input[name="template"]:checked+.form-check .form-check-label img {
            filter: grayscale(5%) brightness(.9);
        }

        .template-image {
            transition: filter 0.3s ease;
        }

        .badge:hover {
            cursor: pointer;
        }
        .card-content-form {
            margin-bottom: 4rem;
            border: 1px solid #e5e5e5;
            padding: 8px;
            border-radius: 3px;
            margin-bottom: 1em;
            background-color: #f5f5f5;
        }

        .form-control {
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            padding: 0.21rem 0.75rem;
        }

        .form-control:focus {
            border: 1px solid #54b4d3;
            box-shadow: none;
        }

        .btn {
            border-radius: 3px;
            padding: 0.5rem 0.8rem;
        }

        .card-header {
            border-width: 0px !important;
        }

        #cardBodyPendidikan,
        #cardBodyPengalaman,
        #cardBodySosial,
        #cardBodyPortofolio {
            padding-top: 0px;
        }
    </style>
@endsection

@section('content')
    <section class="mt-3">
        <div class="container">
            <div class="wizard fixed-top-container">
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
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    @include('pages.parts.nav-tabs', ['steps' => $contents])
                </ul>
            </div>
            <form method="POST" action="{{ url('preview') }}" enctype="multipart/form-data" id="formCvKerja">
                @csrf
                <input type="hidden" id="snapToken" name="snap_token">
                <input type="hidden" id="responseVal" name="responseVal">
                <input type="hidden" id="templateUse" name="template_use" value="1">
                <input type="hidden" id="langUse" name="lang_use" value="id">
                <input type="hidden" id="orderId" name="order_id" value="{{ request('order_id') ?? '' }}">
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

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    @include('js.cv-kerja')
    @include('js.tabs')
@endSection
