@extends('layouts.app')

@section('description', 'Buat CV Profesional dengan Mudah di Lokersulawesi.com | Tingkatkan Peluang Karirmu di Sulawesi. Lokersulawesi.com menyediakan CV Maker terpercaya yang memungkinkanmu membuat CV menarik dan profesional secara cepat. Dengan berbagai template modern dan pilihan kustomisasi yang luas, buat CV yang mencerminkan kepribadianmu dan sesuai dengan kebutuhan perekrut di Sulawesi. Tingkatkan peluangmu dalam mencari pekerjaan impian dengan CV yang menonjol dari CV Maker Lokersulawesi.com. Dapatkan keunggulan di pasar kerja Sulawesi dengan alat CV terbaik kami.')
@section('keywords', 'CV maker, CV profesional, lowongan kerja, peluang karir, Sulawesi, pencari kerja, CV menarik, CV kreatif, CV online, template CV, alat CV, Lokersulawesi.com')

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

                    @include('pages.parts.cv-kerja-sosial')

                    @include('pages.parts.cv-kerja-pengalaman')

                    @include('pages.parts.cv-kerja-keahlian')


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
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="https://cdn.tiny.cloud/1/fioab1f7iscuty6onrm6ezlq795cnlvwjy81btkvag3piuoj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

            if (validation() > 0) {
                swal({
                    title: 'Info',
                    text: 'Terdapat data yang harus di isi',
                    icon: 'info',
                    button: true,
                })
                .then(() => {
                    $('#modalPilihTemplate').modal('hide');
                });

                return
            }

            $(`#formCvKerja`).attr('action', `{{ url('download') }}`);
            $(`#formCvKerja`).submit();
        }

        function validation() {
            let is_valid = 0;

            $('.custom_validation').each(function() {
                $(this).removeClass('is-invalid');
                $(this).removeClass('custom_invalid');
                if ($(this).val() == '') {
                    const fieldText = $(this).prev('label').text();
                    
                    $(this).addClass('is-invalid');
                    $(this).after(`<div class="invalid-feedback mt-1 custom_invalid">${fieldText} harus diisi.</div>`);
                    
                    is_valid++;
                }
            });

            return is_valid;
        }


        function preview() {
            selectTemplate();

            $(`#formCvKerja`).attr('action', `{{ url('preview') }}`);
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

        function addTinyMce()
        {
            tinymce.init({
                selector: 'textarea.tiny',
                forced_root_block : 'div'
            });
        }

        addTinyMce()

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
