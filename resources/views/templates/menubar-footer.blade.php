<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/') }}">
            <button class="btn-menubar">
                <i class="fa fa-home color-2 {{ $menu == 'home' ? 'menu-active' : '' }}" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2 {{ $menu == 'home' ? 'menu-active' : '' }}" style="font-size: 10px">Home</span>
            </button>
        </a>
        <a href="{{ url('transaksi') }}">
            <button class="btn-menubar">
                <i class="fa fa-list color-2 {{ $menu == 'template' ? 'menu-active' : '' }}" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2 {{ $menu == 'template' ? 'menu-active' : '' }}" style="font-size: 10px">Pilih Template</span>
            </button>
        </a>
        <a href="{{ url('transaksi') }}">
            <button class="btn-menubar">
                <i class="fa fa-pencil color-2 {{ $menu == 'preview' ? 'menu-active' : '' }}" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2 {{ $menu == 'preview' ? 'menu-active' : '' }}" style="font-size: 10px">Preview</span>
            </button>
        </a>
        <a href="{{ url('akun') }}">
            <button class="btn-menubar">
                <i class="fa fa-user color-2 {{ $menu == 'akun' ? 'menu-active' : '' }}" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2 {{ $menu == 'akun' ? 'menu-active' : '' }}" style="font-size: 10px">Akun</span>
            </button>
        </a>
        <!-- <a href="{{ route('logout') }}">
            <button class="btn-menubar">
                <i class="fa fa-sign-out" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                <span style="color: #5f5f5f; font-size: 10px">Logout</span>
            </button>
        </a> -->
    </div>
</nav>
