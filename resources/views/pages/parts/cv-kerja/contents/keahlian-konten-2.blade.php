<div class="row">
    <div class="col-md-5 mb-3">
        <label for="namaKeahlian" class="mb-1">Nama Keahlian</label>
        <input type="text" class="form-control" name="keahlian[nama_keahlian][]" placeholder="Contoh: PHP">
    </div>
    <div class="col-md-5 mb-3">
        <label for="levelKeahlian" class="mb-1">Level Keahilan</label>
        <select  class="form-control" name="keahlian[level_keahlian][]">
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Senior">Senior</option>
            <option value="Berpengalaman">Berpengalaman</option>
            <option value="Profesional">Profesional</option>
        </select>
    </div>
    <div class="col-md-2 mb-3">
        <div class="btn btn-danger mt-4" onclick="removeFormInline(this)">
            <i class="fa fa-times"></i>
        </div>
    </div>
</div>
