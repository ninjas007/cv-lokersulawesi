<div class="card-content-form">

    @include('pages.parts.cv-kerja.components.btn-form-card')

    <div class="form-group mb-3">
        <label for="namaPortofolio" class="mb-1">Nama Portofolio</label>
        <input type="text" class="form-control" name="portofolio[nama_portofolio][]"
            placeholder="Contoh: Administrasi">
    </div>
    <div class="form-group">
        <label for="deskripsiPortofolio" class="mb-1">Deskripsi Portofolio <span class="small text-info">(jelaskan portofolio)</span></label>
        <textarea class="tiny form-control" name="portofolio[deskripsi_portofolio][]"  cols="30" rows="5" placeholder="Portofolio ini dibuat menggunakan Microsoft Excel"></textarea>
    </div>
</div>
