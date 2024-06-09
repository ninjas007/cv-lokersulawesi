<div style="margin-bottom: 4rem">
    <div class="btn btn-danger mb-3" onclick="removeFormCard(this)">
        <i class="fa fa-times"></i>
    </div>
    <div class="form-group mb-3">
        <label for="posisi" class="mb-1">Posisi / Jabatan</label>
        <input type="text" class="form-control" name="pengalaman[posisi][]"
            placeholder="Contoh: Administrasi">
    </div>
    <div class="form-group mb-3">
        <label for="kota" class="mb-1">Kota</label>
        <input type="text" class="form-control" name="pengalaman[kota][]" placeholder="Contoh: Jakarta">
    </div>
    <div class="form-group mb-3">
        <label for="perusahaan" class="mb-1">Perusahaan</label>
        <input type="text" class="form-control" name="pengalaman[perusahaan][]" placeholder="Contoh: PT. Garuda Food">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="bulan_tahun_masuk" class="mb-1">Bulan dan Tahun Masuk</label>
                <input type="text" class="form-control" name="pengalaman[bulan_tahun_masuk][]"  placeholder="Contoh: September 2018">
            </div>
            <div class="col-md-6 mb-3">
                <label for="bulan_tahun_keluar" class="mb-1">Bulan dan Tahun Keluar</label>
                <input type="text" class="form-control" name="pengalaman[bulan_tahun_keluar][]"  placeholder="Contoh: Januari 2021">
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="deksiripsPekerjaan" class="mb-1">Deskripsi Pekerjaan <span class="small text-info">(jika ada)</span></label>
        <textarea class="tiny form-control" name="pengalaman[deskripsi_pekerjaan][]"  cols="30" rows="5" placeholder="Membuat laporan menggunakan excel, membuat audit keuangan, dll"></textarea>
    </div>
</div>
