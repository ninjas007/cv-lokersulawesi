@extends('print.cv-kerja.index')

@section('css')
    <style>
        table tr,
        table tr td {
            page-break-inside: auto !important;
        }

        .fixed-button-container {
            position: fixed;
            bottom: 20px;
            right: 0;
            left: 0;
            z-index: 100;
            font-size: 24px;
            background-color: red;
            text-align: center;
            padding: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 24px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-primary i {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="profile-section" style="padding: 20px 25px; line-height: 1.3; margin-top: -20px">
        <table>
            <tr>
                <td width="15%" style="vertical-alignt: middle !important">
                    @php
                        $photo = $data['name_foto'] ?? 'default.jpg';
                    @endphp
                    <img src="{{ asset('assets/photos/' . $photo . '') }}" alt="image" width="100%" height="110px"
                        style="border-radius: 5%; object-fit: cover">
                </td>
                <td width="3%">&nbsp;</td>
                <td width="85%">
                    <div style="font-weight: bold; font-size: 24px">{{ $data['nama'] ?? '' }}</div>
                    <hr>
                    {!! !empty($data['ringkasan_profil']) ? $data['ringkasan_profil'] : '<div style="height: 30px;">&nbsp;</div>' !!}
                </td>
            </tr>
        </table>
    </div>
    <div style="padding: 25px; padding-top: 0px; line-height: 2">
        <table>
            <tr>
                <td width="35%">
                    <table style="margin-top: 15px; line-height: 1.5">
                        <tr>
                            <td colspan="3" class="bold">
                                <div style="font-size: 15px" class="uppercase">@lang('biodata.profile')</div>
                                <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td width="38%">@lang('biodata.name')</td>
                            <td width="2%">:</td>
                            <td> {{ $data['nama'] }}</td>
                        </tr>
                        @php
                            $jenis_kelamin = '-';
                            if ($data['lang_use'] == 'id') {
                                $jenis_kelamin = $data['jenis_kelamin'] == 'Pria' ? 'Laki-laki' : 'Perempuan';
                            } else {
                                $jenis_kelamin = $data['jenis_kelamin'] == 'Pria' ? 'Male' : 'Female';
                            }
                        @endphp
                        <tr>
                            <td>@lang('biodata.gender')</td>
                            <td>:</td>
                            <td> {{ $jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>@lang('biodata.place')</td>
                            <td>:</td>
                            <td> {{ $data['tempat_lahir'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('biodata.birthday')</td>
                            <td>:</td>
                            <td> {{ \Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>@lang('biodata.phone')</td>
                            <td>:</td>
                            <td> {{ $data['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('biodata.email')</td>
                            <td>:</td>
                            <td> {{ $data['email'] ?? '' }}</td>
                        </tr>
                    </table>

                    <table style="margin-top: 10px; line-height: 1.5">
                        <tr>
                            <td class="bold">
                                <div style="font-size: 15px;" class="uppercase">@lang('biodata.address')</div>
                                <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $data['alamat_lengkap'] }}
                            </td>
                        </tr>
                    </table>

                    @isset($data['sosial_media'])
                        <table style="margin-top: 10px">
                            <tr>
                                <td class="bold">
                                    <div style="font-size: 15px" class="uppercase">@lang('biodata.social_media')</div>
                                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                                </td>
                            </tr>
                            @for ($i = 0; $i < count($data['sosial_media']['nama']); $i++)
                                <tr>
                                    <td>
                                        <a href="{{ $data['sosial_media']['link'][$i] }}" style="color: #000;" target="_blank">
                                            {{ $data['sosial_media']['link'][$i] }}
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </table>
                    @endisset
                </td>
                <td width="10%">&nbsp;</td>
                <td width="60%">
                    @isset($data['pendidikan'])
                        <table style="margin-top: 10px">
                            <tr>
                                <td class="bold">
                                    <div style="font-size: 15px" class="uppercase">@lang('biodata.education')</div>
                                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                                </td>
                            </tr>

                            @for ($i = 0; $i < count($data['pendidikan']['sekolah']); $i++)
                                <tr>
                                    <td>
                                        <span class="bold">{{ $data['pendidikan']['sekolah'][$i] }}</span> -
                                        {{ $data['pendidikan']['kota'][$i] }} <br>
                                        <span style="font-style: italic">{{ $data['pendidikan']['tahun_masuk'][$i] }} -
                                            {{ $data['pendidikan']['tahun_keluar'][$i] }}</span>

                                        @if (!empty($data['pendidikan']['jurusan'][$i]))
                                            <br>
                                            <span>{{ $data['pendidikan']['jurusan'][$i] }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor

                        </table>
                    @endisset

                    @if (
                        !empty($data['deskripsi_keahlian']) ||
                            (count($data['keahlian']) > 0 && !empty($data['keahlian']['nama_keahlian'][0])))
                        <table style="margin-top: 10px">
                            <tr>
                                <td class="bold">
                                    <div style="font-size: 15px" class="uppercase">@lang('biodata.skills')</div>
                                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                                </td>
                            </tr>
                            <tr>
                                @if ($data['tipe_input_keahlian'] == 'text')
                                    <td>
                                        {!! $data['deskripsi_keahlian'] !!}
                                    </td>
                                @else
                                    <td>
                                        <div style="margin-bottom: 5px">{{ $data['keahlian']['nama_keahlian'][$i] }} :
                                            {{ $data['keahlian']['level_keahlian'][$i] }}</div>
                                    </td>
                                @endif
                            </tr>
                        </table>
                    @endif

                </td>
            </tr>

        </table>

        <table style="margin-top: 10px;">
            <tr style="page-break-inside: auto">
                <td class="bold">
                    <div style="font-size: 15px" class="uppercase">@lang('biodata.experience')</div>
                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                </td>
            </tr>
            @for ($i = 0; $i < count($data['pengalaman']['posisi']); $i++)
                <tr style="page-break-inside: auto">
                    <td>
                        <div style="page-break-inside: auto">
                            <span class="bold">{{ $data['pengalaman']['perusahaan'][$i] }}</span>
                            <span>{{ $data['pengalaman']['kota'][$i] }}</span>
                        </div>
                        <div style="page-break-inside: auto">
                            <span>{{ $data['pengalaman']['posisi'][$i] }}</span>
                        </div>
                        <div style="page-break-inside: auto">
                            <span>{{ $data['pengalaman']['bulan_tahun_masuk'][$i] }} -
                                {{ $data['pengalaman']['bulan_tahun_keluar'][$i] }}</span>
                        </div>

                        @if (!empty($data['pengalaman']['deskripsi_pekerjaan'][$i]))
                            <div style="margin-top: 5px; page-break-inside: auto">{!! $data['pengalaman']['deskripsi_pekerjaan'][$i] !!}</div>
                        @endif
                    </td>
                </tr>
            @endfor
        </table>

        <table style="margin-top: 10px;">
            <tr style="page-break-before: always">
                <td class="bold">
                    <div style="font-size: 15px" class="uppercase">@lang('biodata.portofolio')</div>
                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                </td>
            </tr>
            @for ($i = 0; $i < count($data['portofolio']['nama_portofolio']); $i++)
                <tr style="page-break-inside: auto">
                    <td>
                        <span class="bold">{{ $data['portofolio']['nama_portofolio'][$i] }}</span>
                        @if ($data['portofolio']['deskripsi_portofolio'][$i])
                            <br>
                            <span style="font-style: italic">
                                {!! $data['portofolio']['deskripsi_portofolio'][$i] !!}
                            </span>
                        @endif
                    </td>
                </tr>
            @endfor
        </table>
    </div>

    {{-- fixed button bottom print --}}
    <div class="fixed-button-container">
        <button type="button" id="printBtn" class="btn btn-primary">
            <i class="fa fa-print"></i> DOWNLOAD
        </button>
    </div>
    <input type="hidden" id="preview" value="{{ $preview ?? '0' }}">
@endsection


@section('js')
    <script>
        document.getElementById('printBtn').onclick = function() {
            var newWindow = window.open(``, '_blank'); // Buka jendela baru terlebih dahulu
            var preview = document.getElementById('preview');

            setTimeout(function() { // Berikan waktu singkat untuk memastikan jendela baru tidak diblokir
                var element = document.getElementById('content');

                var opt = {
                    margin: [12, 15],
                    filename: 'Curriculum Vitae.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    },
                    pagebreak: {
                        mode: 'avoid',
                        before: '.page-break',
                        after: '.page-break',
                        height: 295 - (20 / 25.4),
                    },
                };

                if (preview.value == 0) {
                    html2pdf().from(element)
                        .set(opt)
                        .toPdf()
                        .save();
                } else {
                    html2pdf().from(element)
                        .set(opt)
                        .toPdf()
                        .get('pdf')
                        .then(function(pdf) {
                            var dataURI = pdf.output('datauristring');

                            // Tulis konten ke jendela baru
                            newWindow.document.write('<iframe width="100%" height="100%" src="' + dataURI +
                                '"></iframe>');

                            // Tutup jendela saat ini setelah jeda singkat untuk memastikan dokumen ditulis
                            setTimeout(function() {
                                window.close();
                            }, 500);
                        });
                }
            }, 500);
        };
    </script>
@endsection
