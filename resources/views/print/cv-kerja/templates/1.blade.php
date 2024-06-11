@extends('print.cv-kerja.index')

@section('css')
    <style>
        * {
            color: #3f3d3de5;
            line-height: 1.8 !important;
        }

        table,
        tr {
            page-break-before: auto;
            page-break-after: auto;
        }

        table tr td {
            padding: 0px;
        }

        a {
            color: #3f3d3de5;
        }
    </style>
@endsection

@section('content')
    <table style="margin-bottom: 10px">
        <tr>
            <td width="90%">
                <div style="font-size: 26px; font-weight: bold;">{{ $data['nama'] ?? '-' }}</div>
            </td>
            @php
                $photo = $data['name_foto'] ?? 'default.jpg';
            @endphp
            <td rowspan="2">
                <img src="{{ asset('assets/photos/' . $photo . '') }}" alt="image" width="100px" height="110px"
                    style="border-radius: 5%; object-fit: cover">
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        @php
                            $jenis_kelamin = '-';
                            if ($data['lang_use'] == 'id') {
                                $jenis_kelamin = $data['jenis_kelamin'] == 'Pria' ? 'Laki-laki' : 'Perempuan';
                            } else {
                                $jenis_kelamin = $data['jenis_kelamin'] == 'Pria' ? 'Male' : 'Female';
                            }
                        @endphp
                        <td width="25%">@lang('biodata.gender')</td>
                        <td width="30%">: {{ $jenis_kelamin }}</td>
                        <td rowspan="3">
                            <div style="padding-right: 10px">
                                @lang('biodata.address') <br>
                                {{ $data['alamat_lengkap'] ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('biodata.place_birthday')</td>
                        <td>: {{ $data['tempat_lahir'] ?? '-' }},
                            {{ $data['tanggal_lahir'] ? \Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('biodata.phone')</td>
                        <td>: {{ $data['no_hp'] ?? '-' }}</td>
                    </tr>

                    @isset($data['sosial_media'])
                        <tr>
                            <td colspan="3">
                                @php
                                    $length = count($data['sosial_media']['nama']);
                                    if ($length > 0 && $data['sosial_media']['nama'] == '') {
                                        $length = 0;
                                    }
                                @endphp
                                @for ($i = 0; $i < $length; $i++)
                                    <a href="{{ $data['sosial_media']['link'][$i] }}" target="_blank"
                                        style="text-decoration: none; color: #000; font-size: 10px">{{ $data['sosial_media']['link'][$i] ?? '' }}
                                    </a>
                                    {{ $length - $i != 1 ? '|' : '' }}
                                @endfor
                            </td>
                        </tr>
                    @endisset
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 10px">
        <tr>
            <td>
                <div
                    style="font-size: 16px; font-weight: bold; text-transform: uppercase; border-bottom: .7px solid #3f3d3de5;">
                    @lang('biodata.about')</div>
            </td>
        </tr>
        <tr>
            <td>
                {!! !empty($data['ringkasan_profil']) ? $data['ringkasan_profil'] : '<div style="height: 20px;">&nbsp;</div>' !!}
            </td>
        </tr>
    </table>

    @isset($data['pendidikan'])
        <table style="margin-bottom: 10px">
            <tr>
                <td colspan="2">
                    <div
                        style="font-size: 16px; font-weight: bold; text-transform: uppercase; border-bottom: .7px solid #3f3d3de5;">
                        @lang('biodata.education')</div>
                </td>
            </tr>

            @for ($i = 0; $i < count($data['pendidikan']['sekolah']); $i++)
                <tr>
                    <td>
                        <div class="bold">{{ $data['pendidikan']['sekolah'][$i] }}</div>
                    </td>
                    <td align="right">
                        <div class="bold">{{ $data['pendidikan']['kota'][$i] }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if (!empty($data['pendidikan']['jurusan'][$i]))
                            <div style="margin-bottom: 5px">{{ $data['pendidikan']['jurusan'][$i] }}</div>
                        @endif
                    </td>
                    <td align="right">
                        {{ $data['pendidikan']['tahun_masuk'][$i] }} - {{ $data['pendidikan']['tahun_keluar'][$i] }}
                    </td>
                </tr>
            @endfor
        </table>
    @endisset

    @if (
        !empty($data['deskripsi_keahlian']) ||
            (count($data['keahlian']) > 0 && !empty($data['keahlian']['nama_keahlian'][0])))
        <table style="margin-bottom: 10px">
            <tr>
                <td>
                    <div class="suheading">@lang('biodata.skills')</div>

                </td>
            </tr>
            <tr>
                <td>
                    @if (count($data['keahlian']) > 0 && !empty($data['keahlian']['nama_keahlian'][0]))
                        <ol>
                            @for ($i = 0; $i < count($data['keahlian']); $i++)
                                <li>{{ $data['keahlian']['nama_keahlian'][$i] }} :
                                    {{ $data['keahlian']['level_keahlian'][$i] }}</li>
                            @endfor
                        </ol>
                    @else
                        {!! $data['deskripsi_keahlian'] ?? '-' !!}
                    @endif

                </td>
            </tr>
        </table>
    @endif

    @isset($data['pengalaman'])
        <table style="margin-bottom: 10px;">
            <tr>
                <td colspan="2">
                    <div
                        style="font-size: 16px; font-weight: bold; text-transform: uppercase; border-bottom: .7px solid #3f3d3de5;">
                        @lang('biodata.experience')</div>

                </td>
            </tr>
            @for ($i = 0; $i < count($data['pengalaman']['posisi']); $i++)
                <tr>
                    <td>
                        <div class="bold">{{ $data['pengalaman']['posisi'][$i] ?? 'Web Programmer' }}</div>
                    </td>
                    <td align="right" class="bold">
                        {{ $data['pengalaman']['bulan_tahun_masuk'][$i] }} -
                        {{ $data['pengalaman']['bulan_tahun_keluar'][$i] }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="font-style: italic; margin-top: -5px">{{ $data['pengalaman']['perusahaan'][$i] }}</div>
                        <div style="margin-top: 3px; padding-bottom: 8px;">
                            {!! $data['pengalaman']['deskripsi_pekerjaan'][$i] !!}
                        </div>
                    </td>
                </tr>
            @endfor
        </table>
    @endisset


    @isset($data['portofolio'])
        <table style="margin-bottom: 10px;">
            <tr>
                <td>
                    <div
                        style="font-size: 16px; font-weight: bold; text-transform: uppercase; border-bottom: .7px solid #3f3d3de5;">
                        @lang('biodata.portofolio')</div>

                </td>
            </tr>

            @for ($i = 0; $i < count($data['portofolio']['nama_portofolio']); $i++)
                <tr style="page-break-inside: auto">
                    <td>
                        <div style="margin-bottom: 5px">
                            <div class="bold">{{ $data['portofolio']['nama_portofolio'][$i] }}</div>
                            {!! $data['portofolio']['deskripsi_portofolio'][$i] !!}
                        </div>
                    </td>
                </tr>
            @endfor
        </table>
    @endisset

    {{-- fixed button bottom print --}}
    {{-- <div class="fixed-button-container">
        <button type="button" id="printBtn" class="btn btn-primary">
            <i class="fa fa-print"></i> PRINT
        </button>
    </div> --}}
@endsection

@section('js')
    <script>
        function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        function printAndKeepOpen() {
            window.print();
        }

        window.onload = function() {
            printAndKeepOpen();

            // Menangani event saat jendela pencetakan ditutup
            window.onafterprint = function() {
                // Jika pengguna bukan dari perangkat seluler, maka tutup jendela
                if (!isMobileDevice()) {
                    // Memberikan jeda sebelum menutup halaman agar jendela pencetakan dapat menyelesaikan prosesnya
                    setTimeout(function() {
                        // Menutup jendela pencetakan
                        window.close();
                    }, 100);
                }
            };

            // Menangani event saat pencetakan dibatalkan atau disimpan
            window.onbeforeprint = function() {
                // Jika pengguna bukan dari perangkat seluler, maka tutup jendela
                if (!isMobileDevice()) {
                    // Memberikan jeda sebelum menutup halaman agar pengguna memiliki kesempatan untuk membatalkan pencetakan
                    setTimeout(function() {
                        // Menutup jendela pencetakan
                        window.close();
                    }, 100);
                }
            };
        };


        // document.getElementById('printBtn').onclick = function() {
        //     var newWindow = window.open(``, '_blank'); // Buka jendela baru terlebih dahulu

        //     // remove fixed button container using javascript vanila
        //     document.getElementsByClassName('fixed-button-container')[0].style.display = 'none';

        //     setTimeout(function() { // Berikan waktu singkat untuk memastikan jendela baru tidak diblokir
        //         var element = document.getElementById('content');

        //         var opt = {
        //             margin: [12, 12, 12, 12],
        //             filename: 'Curriculum Vitae.pdf',
        //             image: {
        //                 type: 'jpeg',
        //                 quality: 0.98
        //             },
        //             html2canvas: {
        //                 scale: 2
        //             },
        //             jsPDF: {
        //                 unit: 'mm',
        //                 format: 'a4',
        //                 orientation: 'portrait'
        //             },
        //             pagebreak: {
        //                 mode: 'avoid',
        //                 before: '.page-break',
        //                 after: '.page-break',
        //                 height: 295 - (20 / 25.4),
        //             },
        //         };

        //         @if (isset($preview))
        //             html2pdf().from(element)
        //                 .set(opt)
        //                 .toPdf()
        //                 .get('pdf')
        //                 .then(function(pdf) {
        //                     var dataURI = pdf.output('datauristring');

        //                     // Tulis konten ke jendela baru
        //                     newWindow.document.write('<iframe width="100%" height="100%" src="' + dataURI +
        //                         '"></iframe>');

        //                     // Tutup jendela saat ini setelah jeda singkat untuk memastikan dokumen ditulis
        //                     setTimeout(function() {
        //                         window.close();
        //                     }, 500);
        //                 });
        //         @else
        //             html2pdf().from(element)
        //                 .set(opt)
        //                 .toPdf()
        //                 .save();
        //         @endif

        //     }, 500);
        // };
    </script>
@endsection
