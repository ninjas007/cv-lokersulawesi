<div class="modal fade" id="modalCustom" tabindex="-1" aria-labelledby="modalCustomLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCustomLabel">Tambah Custom Inputan</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="judul" class="mb-1">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul">
                </div>
                <div class="form-group mb-3">
                    <label for="tipe">Tipe</label>
                    <select name="tipe" id="tipe" class="form-control">
                        <option value="text">Text</option>
                        <option value="list">List</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="tambahCustom()">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
    </div>
</div>