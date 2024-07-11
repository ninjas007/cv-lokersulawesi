@extends('layouts.lowongan')

@section('description', '')
@section('keywords', '')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <style>
        .loading-wrap {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: none;
        }

        .body-wrap {
            min-height: auto;
        }
    </style>
@endsection

@section('content')

    @include('templates.loading')

    <div class="row mb-3">
        <div class="col-12 px-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pasang Lowongan Pekerjaan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('pasang-lowongan/store') }}" method="POST" id="formPasangLowongan" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_pekerjaan" class="mb-1">Nama Pekerjaan</label>
                            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control @error('nama_pekerjaan')
                                is-invalid
                            @enderror" placeholder="Contoh: Programmer" value="{{ old('nama_pekerjaan') }}">

                            @error('nama_pekerjaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="lokasi_pekerjaan" class="mb-1">Lokasi Pekerjaan</label>
                            <input type="text" name="lokasi_pekerjaan" id="lokasi_pekerjaan" class="form-control @error('lokasi_pekerjaan')
                                is-invalid
                            @enderror" placeholder="Contoh: Kendari" value="{{ old('lokasi_pekerjaan') }}">

                            @error('lokasi_pekerjaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tipe_pekerjaan">Tipe Pekerjaan</label>
                            <select name="tipe_pekerjaan" id="tipe_pekerjaan" class="form-control select2 mb-1 @error('tipe_pekerjaan')
                             is-invalid
                            @enderror" style="width: 100%"
                                multiple data-allow-clear="1" placeholder="Pilih tipe pekerjaan">
                                @foreach ($jobTypes as $id => $type)
                                    <option value="{{ $id }}"
                                        {{ $type['slug'] == 'full-time' ? 'selected' : '' }}>{{ $type['name'] }}</option>
                                @endforeach
                            </select>

                            @error('tipe_pekerjaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="link_lowongan" class="mb-1">Link / Email / HP / Whatsapp yang dapat dihubungi</label>
                            <input type="text" name="link_lowongan" id="link_lowongan" class="form-control @error('link_lowongan')
                            is-invalid
                            @enderror" value="{{ old('link_lowongan') }}">

                            @error('link_lowongan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="gaji" class="mb-1">Gaji per bulan</label>
                            <small class="text-info">(optional)</small>
                            <input type="number" name="gaji" id="gaji" class="form-control @error('gaji')
                                is-invalid
                            @enderror" placeholder="Contoh: 1000000">

                            @error('gaji')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi_pekerjaan" class="mb-1">Deskripsi Pekerjaan / Lamaran</label>
                            <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" class="form-control tiny" cols="30" rows="10">{!! old('deskripsi_pekerjaan') !!}</textarea>

                            @error('deskripsi_pekerjaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <h5 class="bold">Informasi Perusahaan</h5>

                        <div class="form-group mb-3">
                            <label for="nama_perusahaan" class="mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control @error('nama_perusahaan')
                                is-invalid
                            @enderror" placeholder="Contoh: PT. Maju Selalu" value="{{ old('nama_perusahaan') }}">

                            @error('nama_perusahaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="website_perusahaan" class="mb-1">Website perusahaan</label>
                            <small class="text-info">(optional)</small>
                            <input type="text" name="website_perusahaan" id="website_perusahaan" class="form-control" placeholder="Contoh: https://majuselalu.com" value="{{ old('website_perusahaan') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo_perusahaan" class="mb-1">Logo Perusahaan</label>
                            <small class="text-info">(optional)</small>
                            <input type="file" class="form-control" name="logo_perusahaan" id="logo_perusahaan">
                            <small>File yang diizinkan: .jpg, .jpeg, .png, max: 512KB</small>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info w-100 form-control" type="button" onclick="submitForm()">
                               <i class="fa fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.loading-wrap').hide();
        })

        $(function() {
            $('.select2').each(function() {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });

        $('textarea.tiny').summernote({
            tabsize: 0,
            height: 300,
            focus: true,
            popattribution: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        function submitForm() {
            swal({
                title: 'Apakah data anda sudah benar?',
                text: 'Periksa kembali data yang anda inputkan. Semua data yang anda inputkan akan ditinjau kembali oleh admin',
                icon: 'info',
                classes: 'loading-wrap',
                buttons: true,
            })
            .then((confirm) => {
                if (confirm) {
                    document.getElementById('formPasangLowongan').submit();
                }
            })
        }
    </script>
@endSection
