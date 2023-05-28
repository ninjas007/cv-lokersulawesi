@extends('menus.preview.index')

@section('css')
    <style>
        @page {
            margin: 20px 30px !important;
            color: #3f3d3de5;
            line-height: 1.6;
        }

        tr {
            page-break-before: auto;
            page-break-after: auto;
        }

        table {
            page-break-before: auto;
            page-break-after: auto;
        }

        table tr td {
            padding: 0px
        }

        a {
            color: #3f3d3de5;
            /* text-decoration: none */
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
                <img src="{{ public_path('storage/assets/photos/' . $photo . '') }}" alt="image" width="100px" height="100px" style="border-radius: 50%">
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td width="21%">Jenis Kelamin</td>
                        <td width="40%">: {{ $data['jenis_kelamin'] ?? '-' }}</td>
                        <td rowspan="3">
                            <div style="padding-right: 10px">
                                Alamat: <br>
                                {{ $data['alamat_lengkap'] ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: {{ $data['tempat_lahir'] ?? '-' }},
                            {{ $data['tanggal_lahir'] ? \Carbon\Carbon::parse($data['tanggal_lahir'])->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>No Telp / HP</td>
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
                                    <a href="{{ $data['sosial_media']['link'][$i] }}"
                                        target="_blank">{{ $data['sosial_media']['nama'][$i] ?? '' }}
                                    </a>
                                    {{ ($length - $i != 1) ? '|' : '' }}
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
                <div style="font-size: 16px; font-weight: bold">TENTANG SAYA</div>
                <div class="garis"></div>
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
                <div style="font-size: 16px; font-weight: bold">PENDIDIKAN</div>
                <div class="garis"></div>
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
                    
                    {{-- TODO: add riwayat pendidikan maybe deskripsi --}}
                    {{-- <div>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                </div> --}}
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
                    <div style="font-size: 16px; font-weight: bold;">KEAHLIAN</div>
                    <div class="garis"></div>
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
        <table style="margin-bottom: 10px">
            <tr>
                <td colspan="2">
                    <div style="font-size: 16px; font-weight: bold;">PENGALAMAN KERJA</div>
                    <div class="garis"></div>
                </td>
            </tr>
            @for ($i = 0; $i < count($data['pengalaman']['posisi']); $i++)
                <tr>
                    <td>
                        <div class="bold">{{ $data['pengalaman']['posisi'][$i] ?? 'Web Programmer'}}</div>
                    </td>
                    <td align="right" class="bold">
                        {{ $data['pengalaman']['bulan_tahun_masuk'][$i] }} - {{ $data['pengalaman']['bulan_tahun_keluar'][$i] }}
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
                    <div style="font-size: 16px; font-weight: bold;">PORTOFOLIO</div>
                    <div class="garis"></div>
                </td>
            </tr>

            @for ($i = 0; $i < count($data['portofolio']['nama_portofolio']); $i++)
                <tr>
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
@endsection
