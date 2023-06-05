<!-- Modal Pilih Template-->
<div class="modal fade" id="modalAkun" tabindex="-1" aria-labelledby="modalAkun" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center vh-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Akun</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <ul class="list-group list-group-light mb-3">
                            <li class="list-group-item disabled" aria-disabled="true">{{ auth()->user()->name }}</li>
                            <li class="list-group-item">{{ auth()->user()->email }}</li>
                        </ul>
                        <a class="btn btn-primary" href="{{ url('akun/transaksi') }}">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary text-white">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
