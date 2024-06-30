@extends('layouts.lowongan')

@section('meta')
    <meta name="description"
        content="Loker Sulawesi adalah website yang menyediakan lowongan kerja untuk wilayah indonesia bagian sulawesi">
    <meta name="keywords" content="Loker Sulawesi, lowongan kerja sulawesi, sulawesi, sulawesi selatan, sulawesi barat">

    <title>LOKER SULAWESI</title>
@endsection

@section('css')
    @include('jobs.style')
@endsection

@section('content')
    @include('templates.loading')

    <div class="row">
        <div class="col-12">
            <!-- Carousel wrapper -->
            <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                <!-- Inner -->
                <div class="carousel-inner">
                    <!-- Single item -->
                    <div class="carousel-item">
                        <img src="https://awsimages.detik.net.id/community/media/visual/2022/11/20/rijsttafel-indonesia-2.jpeg?w=1200"
                            class="d-block w-100" alt="Image 1" style="max-height: 150px; object-fit: cover">
                        <div class="carousel-caption">
                            <div class="text-info title-banner">LOKER SULAWESI</div> <br>
                            <p>Website informasi pekerjaan dan peluang kerja untuk Wilayah Indonesia Timur</p>
                        </div>
                    </div>

                    <!-- Single item -->
                    <div class="carousel-item active">
                        <img src="https://e1.pxfuel.com/desktop-wallpaper/758/101/desktop-wallpaper-medicadventurer%E2%84%A2-on-wonderful-indonesia-wonderful-indonesia.jpg"
                            class="d-block w-100" alt="Image 2" style="max-height: 150px; object-fit: cover">
                        <div class="carousel-caption caption-2">
                            <p>Buat CV impianmu secara profesional di Loker Sulawesi dengan lebih mudah
                            </p>
                            <a href="https://cv.lokersulawesi.com/cv-kerja" target="_blank" class="btn btn-info btn-sm">
                                CV Loker Sulawesi
                            </a>
                        </div>
                    </div>

                </div>
                <!-- Inner -->

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 px-4">
            <button class="btn btn-info text-white form-control" data-mdb-toggle="modal" data-mdb-target="#addProduct">
                <i class="fa fa-plus"></i> Post Loker</button>
        </div>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-12 px-4">
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Search foods or drinks from indonesia"
                    aria-label="Search" id="search-value" aria-describedby="search-addon" value="" onkeyup="filter()">
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
    </div> --}}
    <div class="row" style="margin-bottom: 20px">
        <div class="col-12 px-4" id="jobs">
            {{-- load content jobs --}}
        </div>
        <div class="col-12 px-4">
            <button class="form-control btn btn-info" onclick="loadMore()" id="loadMore">
                <i class="fa fa-repeat"></i> LIHAT LAINNYA
            </button>
        </div>
    </div>
@endsection
@include('jobs.modal-share')

@section('js')
    <script>
        function loadMore() {
            let offset = $('.list-job').length;
            getJobs(offset, true);
        }

        function getJobs(offset = 0, loadMore = false) {
            $.ajax({
                url: "{{ url('lowongan') }}?offset=" + offset,
                type: "GET",
                beforeSend: function() {
                    if (!loadMore) {
                        $('.loading-wrap').show();
                    } else {
                        $('#loadMore').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
                        $('#loadMore').attr('disabled', 'disabled');
                    }
                },
                success: function(data) {
                    if (data == "") {
                        $('#loadMore').remove();
                    } else {
                        if (!loadMore) {
                            $('.loading-wrap').hide();
                        } else {
                            $('#loadMore').html('<i class="fa fa-repeat"></i> LIHAT LAINNYA');
                            $('#loadMore').removeAttr('disabled');
                        }

                        $('#jobs').append(data);
                    }

                }
            });
        }

        function showModal(url) {
            $('#share').find('#shareFacebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${url}`);
            $('#share').find('#shareWhatsapp').attr('href', 'https://api.whatsapp.com/send?text=' + url);
            $('#share').find('#shareLinkedin').attr('href', `https://www.linkedin.com/shareArticle?mini=true&url=${url}`);
        }

        getJobs();
    </script>
@endSection
