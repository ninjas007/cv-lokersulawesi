<!-- Modal Pilih Template-->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center vh-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login User</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center mb-5">
                        @include('pages.parts.info-login')
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <a href="{{ url('auth/google') }}" class="btn btn-success text-white">
                            Login Google
                        </a>
                    </div>
                    {{-- <div class="col-md-12 text-center">
                        <a href="{{ url('auth/facebook') }}" class="btn btn-primary text-white">
                            Login Facebook
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
