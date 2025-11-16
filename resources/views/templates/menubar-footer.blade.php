<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/') }}">
            <button class="btn-menubar">
                <i class="fa fa-home color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Loker</span>
            </button>
        </a>
        {{-- TODO: nanti muncul modal tips untuk nulis cv yang baik --}}
        <a href="https://lokersulawesi.com/4-hal-penting-yang-harus-ada-di-cv-kamu/" target="_blank">
            <button class="btn-menubar">
                <i class="fa fa-list color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Tips</span>
            </button>
        </a>
        <a href="{{ url('history') }}">
            <button class="btn-menubar">
                <i class="fa fa-pencil color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">History</span>
            </button>
        </a>
        @guest
            <a href="javascript:void(0)">
                <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalLogin">
                    <i class="fa fa-sign-in color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                    <span class="color-2" style="font-size: 10px">Login</span>
                </button>
            </a>
        @else
            <a href="javascript:void(0)">
                <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalAkun">
                    <i class="fa fa-user" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                    <span style="color: #5f5f5f; font-size: 10px">Akun</span>
                </button>
            </a>
        @endguest
    </div>
</nav>
