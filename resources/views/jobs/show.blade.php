@extends('layouts.lowongan')

@section('description', '')
@section('keywords', '')

@section('css')
    @include('jobs.style')

    {!! $job['yoast_head'] !!}

    <style>
        .loading-wrap {
            display: block;
        }
    </style>
@endsection

@section('content')

    @include('templates.loading')

    <div class="row mb-3 mt-3">
        <div class="col-12 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ $job['image'] }}" style="width: 100%; height: 100px; object-fit: contain">
                        </div>
                        <div class="col-10 d-flex flex-column">
                            <div class="mb-2">
                                <div class="h4 text-info">
                                    <i class="fa fa-building h4"></i> {{ $job['company'] }}
                                </div>
                                <div>Posisi yang dibutuhkan sebagai:</div>
                                <div class="h5">
                                     {!! $job['title'] !!}
                                </div>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class=" text-muted">
                                        <i class="fa fa-map-marker"></i> Lokasi : {{ $job['location'] }}
                                    </div>
                                    <div>
                                        @foreach ($job['job_types'] as $type)
                                            {!! $type['html_name'] !!}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 px-4" id="job">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="h4">Detail Lowongan</div>
                            <hr>
                            <div>
                                {!! $job['content'] !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between align-items-end">
                        <small class="text-muted bold">
                            Dipublikasikan {{ $job['publish_on'] }}
                        </small>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="bold me-2 text-muted">Share:</div>
                            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}">
                                <i class="text-success fa-brands fa-whatsapp" style="font-size: 20px"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="mx-2">
                                <i class="text-info fa-brands fa-facebook" style="font-size: 20px"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}">
                                <i class="fa-brands fa-linkedin" style="font-size: 20px"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-2">
        <div class="col-12 px-4 py-4">
            <a href="{{ url('/lowongan') }}" class="btn btn-info btn-lg form-control">
               <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.loading-wrap').hide();
        })
    </script>
@endSection
