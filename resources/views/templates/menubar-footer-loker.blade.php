<nav class="navbar-wrap">
    <div class="menubar-footer">
        @if (isset($about))
            <a href="{{ url('/lowongan') }}" class="btn btn-info btn-lg form-control my-3">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        @else
            <a href="{{ url('https://lokersulawesi.com') }}">
                <button class="btn-menubar">
                    <i class="fa fa-home color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                    <span class="color-2" style="font-size: 10px">Home</span>
                </button>
            </a>
            <a href="https://cv.lokersulawesi.com/cv-kerja" target="_blank">
                <button class="btn-menubar">
                    <i class="fa fa-pencil color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                    <span class="color-2" style="font-size: 10px">Buat CV</span>
                </button>
            </a>
            <a href="https://lokersulawesi.com/artikel">
                <button class="btn-menubar">
                    <i class="fa fa-list color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                    <span class="color-2" style="font-size: 10px">Artikel</span>
                </button>
            </a>
            <a href="{{ url('about') }}">
                <button class="btn-menubar">
                    <i class="fa fa-comment color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                    <span class="color-2" style="font-size: 10px">Tentang</span>
                </button>
            </a>
        @endif
    </div>
</nav>
