<div class="row">
    <div class="col-md-5 mb-3">
        <label for="namaKeahlian" class="mb-1">Nama Keahlian</label>
        <input type="text" class="form-control" name="keahlian[nama_keahlian][]" placeholder="Contoh: PHP">
    </div>
    <div class="col-md-5 mb-3">
        <label for="levelKeahlian" class="mb-1">Level Keahilan</label>
        <select  class="form-control" name="keahlian[level_keahlian][]">
            <option value="0">Pemula</option>
            <option value="1">Menengah</option>
            <option value="2">Terampil</option>
            <option value="3">Berpengalaman</option>
            <option value="4">Ahli</option>
        </select>
    </div>
    <div class="col-md-2 mb-3">
        <div class="btn btn-danger mt-4" onclick="removeKeahlian(this)">
            <i class="fa fa-times"></i>
        </div>
    </div>
</div>