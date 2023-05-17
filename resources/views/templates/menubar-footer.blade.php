<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/') }}">
            <button class="btn-menubar">
                <i class="fa fa-home color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Home</span>
            </button>
        </a>
        {{-- TODO: nanti muncul modal tips untuk nulis cv yang baik --}}
        <a href="" target="_blank">
            <button class="btn-menubar">
                <i class="fa fa-list color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Tips</span>
            </button>
        </a>
        <a href="javascript:void(0)">
            <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalPilihTemplate">
                <i class="fa fa-pencil color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Preview</span>
            </button>
        </a>
        {{-- TODO saat save input dia diarahkan login pakai google saja biar mudah dan simpan semua datanya di database --}}
        <a href="javascript:void(0)">
            <button class="btn-menubar" onclick="saveData()">
                <i class="fa fa-save color-2" style="width: 24px; height: 24px; font-size: 20px"></i>
                <span class="color-2" style="font-size: 10px">Save Input</span>
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
