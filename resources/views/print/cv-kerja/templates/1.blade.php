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
                <img src="{{ asset('storage/assets/photos/' . $photo . '') }}" alt="image" width="100px" height="110px"
                    style="border-radius: 5%; object-fit: cover">
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        @php
                            $jenis_kelamin = '-';
                            if ($data['lang_use'] ?? 'id' == 'id') {
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
                                    if ($length > 0 && $data['sosial_media']['nama'][0] == '') {
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
                <div class="subheading">@lang('biodata.about')</div>
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
                    <div class="subheading">@lang('biodata.education')</div>
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
                    <div class="subheading">@lang('biodata.skills')</div>
                </td>
            </tr>
            <tr>
                <td>
                    @if ($data['tipe_input_keahlian'] == 'text')
                        {!! $data['deskripsi_keahlian'] ?? '-' !!}
                    @else
                        <ol style="padding-left: 20px; margin-top: 5px">
                            @for ($i = 0; $i < count($data['keahlian']); $i++)
                                <li>{{ $data['keahlian']['nama_keahlian'][$i] }} :
                                    @lang('keahlian.'.$data['keahlian']['level_keahlian'][$i])</li>
                            @endfor
                        </ol>
                    @endif
                </td>
            </tr>
        </table>
    @endif

    @isset($data['pengalaman'])
        <table style="margin-bottom: 10px;">
            <tr>
                <td colspan="2">
                    <div class="subheading">@lang('biodata.experience')</div>
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


    @if(isset($data['portofolio']) && count($data['portofolio']['nama_portofolio']) > 0 && $data['portofolio']['nama_portofolio'][0] != '')
        <table style="margin-bottom: 10px;">
            <tr>
                <td>
                    <div class="subheading">@lang('biodata.portofolio')</div>
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
    @endif

@endsection

@section('js')
    @include('js.print')
@endsection
