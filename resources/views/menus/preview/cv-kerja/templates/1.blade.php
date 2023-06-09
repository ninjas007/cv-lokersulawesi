@extends('menus.preview.index')

@section('css')
<style>
    @page {
        margin-top: 30px !important;
        line-height: 2;
        color: #3f3d3de5;
    }
</style>
@endsection

@section('content')
    <div style="background-color: #333333; padding: 20px 25px; color: white; line-height: 1.3; margin-top: -30px">
        <table>
            <tr>
                <td width="15%" style="vertical-alignt: middle !important">
                    @php
                        $photo = $data['name_foto'] ?? 'default.jpg';
                    @endphp
                    <img src="{{ public_path('storage/assets/photos/'.$photo.'') }}" alt="image" width="100%" height="100px"
                        style="border-radius: 50%;">
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
                            <td colspan="3" style="font-weight: bold;">
                                <div style="font-size: 15px">PROFIL</div>
                                <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td width="38%">Nama</td>
                            <td width="2%">:</td>
                            <td> {{ $data['nama'] }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td> {{ $data['jenis_kelamin'] }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>:</td>
                            <td> {{ $data['tempat_lahir'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td> {{ \Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>No HP / Telp</td>
                            <td>:</td>
                            <td> {{ $data['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td> {{ $data['email'] ?? '' }}</td>
                        </tr>
                    </table>

                    <table style="margin-top: 10px; line-height: 1.5">
                        <tr>
                            <td style="font-weight: bold;">
                                <div style="font-size: 15px">ALAMAT</div>
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
                                <td style="font-weight: bold;">
                                    <div style="font-size: 15px">SOSIAL MEDIA / KONTAK</div>
                                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                                </td>
                            </tr>
                            @for ($i = 0; $i < count($data['sosial_media']['nama']); $i++)
                                <tr>
                                    <td>
                                        <a href="{{ $data['sosial_media']['link'][$i] }}" style="color: #000;" target="_blank">
                                            {{ $data['sosial_media']['nama'][$i] }}
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
                                <td style="font-weight: bold;">
                                    <div style="font-size: 15px">PENDIDIKAN</div>
                                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                                </td>
                            </tr>

                            @for ($i = 0; $i < count($data['pendidikan']['sekolah']); $i++)
                                <tr>
                                    <td>
                                        <span style="font-weight: bold;">{{ $data['pendidikan']['sekolah'][$i] }}</span> -
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
                                <td style="font-weight: bold;">
                                    <div style="font-size: 15px">KEAHLIAN</div>
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
                                        <div style="margin-bottom: 5px">{{ $data['keahlian']['nama_keahlian'][$i] }} : {{ $data['keahlian']['level_keahlian'][$i] }}</div>
                                    </td>
                                @endif
                            </tr>
                        </table>
                    @endif

                </td>
            </tr>

        </table>

        <table style="margin-top: 10px; page-break-after: always">
            <tr style="page-break-inside: auto">
                <td style="font-weight: bold;">
                    <div style="font-size: 15px">PENGALAMAN</div>
                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                </td>
            </tr>
            @for ($i = 0; $i < count($data['pengalaman']['posisi']); $i++)
                <tr style="page-break-inside: auto">
                    <td>
                        <span style="font-weight: bold;">{{ $data['pengalaman']['posisi'][$i] }}</span> -
                        {{ $data['pengalaman']['kota'][$i] }}<br>
                        <span>{{ $data['pengalaman']['perusahaan'][$i] }}</span> <br>
                        <span style="font-style: italic">{{ $data['pengalaman']['bulan_tahun_masuk'][$i] }}
                            - {{ $data['pengalaman']['bulan_tahun_keluar'][$i] }}</span>

                        @if (!empty($data['pengalaman']['deskripsi_pekerjaan'][$i]))
                            <div style="margin-top: 5px">{!! $data['pengalaman']['deskripsi_pekerjaan'][$i] !!}</div>
                        @endif
                    </td>
                </tr>
            @endfor
        </table>

        <table style="margin-top: 10px;">
            <tr style="page-break-inside: auto">
                <td style="font-weight: bold;">
                    <div style="font-size: 15px">PORTOFOLIO</div>
                    <div style="border: 1px solid #333333; margin: 5px 0px;"></div>
                </td>
            </tr>
            @for ($i = 0; $i < count($data['portofolio']['nama_portofolio']); $i++)
                <tr style="page-break-inside: auto">
                    <td>
                        <span
                            style="font-weight: bold;">{{ $data['portofolio']['nama_portofolio'][$i] }}</span>
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

    </td>
    </div>
@endsection
