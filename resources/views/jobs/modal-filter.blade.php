<div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterLabel">Cari Lowongan</h5>
            </div>
            <div class="modal-body">
                <div class="py-4">
                    <div class="form-group mb-3">
                        <label for="keyword">Kata Kunci</label>
                        <input type="text" class="form-control" id="keyword" name="keyword" onkeypress="return handleKeyPress(event)" autofocus="autofocus">
                    </div>
                    {{-- <div class="form-group">
                        <label for="type">Tipe</label>
                        <select name="type" id="type" class="form-control">
                            <option value="all">Semua</option>
                        </select>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="filterJobs()">
                    <i class="fa fa-search"></i> Apply
                </button>
            </div>
        </div>
    </div>
</div>
