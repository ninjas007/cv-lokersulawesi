@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 70px">
            <div class="col-12">
                <form method="POST" action="{{ url('preview') }}" enctype="multipart/form-data" id="formCvKerja">
                    @csrf
                    <input type="text" style="display: none" value="1" id="templateUse" name="template_use">
                    <input type="hidden" id="snapToken" name="snap_token">
                    <input type="hidden" id="responseVal" name="responseVal">
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

            {{-- @include('pages.modals.modal-custom-inputan') --}}

            @include('pages.modals.modal-pilih-template')

            {{-- @include('pages.modals.modal-preview') --}}
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

        function selectTemplate() {
            template_use = $('input[name="template"]:checked').val();

            $('#templateUse').val(template_use);
        }

        function download() {
            selectTemplate();

            $(`#formCvKerja`).attr('action', `{{ url('download') }}`);
            $(`#formCvKerja`).attr('target', '_blank');
            $(`#formCvKerja`).submit();
        }

        function preview() {
            selectTemplate();

            $(`#formCvKerja`).attr('target', '_blank');
            $(`#formCvKerja`).submit();

            // let data = $("#formCvKerja").serialize();
            // $.ajax({
            //     url: `{{ url('') }}/preview`,
            //     method: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     data: data,
            //     success: function(response) {
            //         console.log(response);
            //         // var element = response;

            //         // html2canvas(element, {
            //         //     background: '#ffffff',
            //         //     onrendered: function(canvas){
            //         //         console.log(canvas)
            //         //         var imgData = canvas.toDataURL('image/jpeg');
            //         //         $('#modalPreview .modal-body').html(response);
            //         //         $('#modalPreview').modal('show');
            //         //         alert('Success!');
            //         //         console.log(imgData);
            //         //     }
            //         // });
                    
                    

            //         // w = window.open(window.location.href,"_blank");
            //         // w.document.open();
            //         // w.document.write(response);
            //         // w.document.close();
            //         // w.window.print();
            //     }
            // })
        }

        // TODO: add custom input
        // function tambahCustom() {
        //     let judul = $('#modalCustom #judul').val();
        //     let tipe = $('#modalCustom #tipe').find(':selected').val();

        //     data_custom.push({
        //         judul: judul,
        //         tipe: tipe
        //     })
        //     localStorage.setItem('data_custom', data_custom);
        // }
    </script>
@endsection
