@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 70px">
            <div class="col-12">
                <form method="POST" action="{{ url('preview') }}" enctype="multipart/form-data" id="formCvKerja">
                    @csrf
                    @include('pages.parts.cv-kerja-data-diri')

                    @include('pages.parts.cv-kerja-pendidikan')

                    @include('pages.parts.cv-kerja-pengalaman')

                    @include('pages.parts.cv-kerja-keahlian')

                    @include('pages.parts.cv-kerja-sosial')

                    @include('pages.parts.cv-kerja-portofolio')
                </form>
            </div>
            {{-- TODO: Add Custom Inputan --}}
            {{-- <div class="col-12 text-center" style="margin-bottom: 75px; margin-top: 10px;">
                <div class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#modalCustom">Tambah Custom Inputan
                </div>
            </div> --}}

            <!-- Modal -->
            <div class="modal fade" id="modalCustom" tabindex="-1" aria-labelledby="modalCustomLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCustomLabel">Tambah Custom Inputan</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="judul" class="mb-1">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tipe">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="text">Text</option>
                                    <option value="list">List</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="tambahCustom()">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Pilih Template-->
            <div class="modal modal-lg fade" id="modalPilihTemplate" tabindex="-1" aria-labelledby="modalPilihTemplate"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pilihTemplate">Pilih Template</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @foreach ($templates as $key => $template)
                                    <div class="col-4">
                                        <img src="{{ asset(''.$template['image'].'') }}" alt="{{ $template['nama'] }}" width="100%" height="100%" class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" name="template" type="radio" value="" id="template{{ $key }}" 
                                            @if ($template['id'] == 1)
                                                checked
                                            @endif>
                                            <label class="form-check-label" for="template{{ $key }}">{{ $template['nama'] }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="pakaiTemplate()">
                                <i class="fa fa-plus"></i> Pakai Template
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        const data_custom = [];

        function tambahPengalaman() {
            let konten = `@include('pages.parts.cv-kerja-pengalaman-konten')`;

            $('#cardBodyPengalaman').append(konten)
        }

        function removePengalaman(elem) {
            elem.parentElement.remove();
        }

        function tambahPendidikan() {
            let konten = `@include('pages.parts.cv-kerja-pendidikan-konten')`;

            $('#cardBodyPendidikan').append(konten)
        }

        function removePendidikan(elem) {
            let row_pendidikan = $('.remove_pendidikan').length;

            elem.parentElement.remove();
        }

        function tambahSosialMedia() {
            let konten = `@include('pages.parts.cv-kerja-sosial-konten')`;

            $('#cardBodySosial').append(konten)
        }

        function removeSosialMedia(elem) {
            elem.parentElement.parentElement.remove();
        }

        function changeTipeInputKeahlian(elem) {
            let value = elem.value;

            if (value == 'text') {
                $('#tipeTextKeahlian').show();
                $('#tipeListKeahlian').hide();
                $('#tambahKeahlian').parent().hide();
            } else {
                $('#tipeTextKeahlian').hide();
                $('#tipeListKeahlian').show();
                $('#tambahKeahlian').parent().show();
            }
        }

        function tambahKeahlian() {
            let konten = `@include('pages.parts.cv-kerja-keahlian-konten-2')`;

            $('#cardBodyKeahlian #tipeListKeahlian').append(konten);
        }

        function removeKeahlian(elem) {
            elem.parentElement.parentElement.remove();
        }

        function tambahPortofolio() {
            let konten = `@include('pages.parts.cv-kerja-portofolio-konten')`;

            $('#cardBodyPortofolio').append(konten);
        }

        function removePortofolio(elem) {
            elem.parentElement.remove();
        }

        function tambahCustom() {
            let judul = $('#modalCustom #judul').val();
            let tipe = $('#modalCustom #tipe').find(':selected').val();

            data_custom.push({
                judul: judul,
                tipe: tipe
            })
            localStorage.setItem('data_custom', data_custom);
        }

        function preview() {
            $(`#formCvKerja`).attr('target', '_blank');
            $(`#formCvKerja`).submit();
        }
    </script>
@endsection
