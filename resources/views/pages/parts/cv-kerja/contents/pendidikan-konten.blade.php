<div style="margin-bottom: 4rem">

    @include('pages.parts.cv-kerja.components.btn-form-card')

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="sekolah" class="mb-1">Sekolah / Kampus</label>
                <input type="text" class="form-control custom_validation" name="pendidikan[sekolah][]"
                    placeholder="Contoh: SD 2 Baruga / Universitas Haluoleo">
            </div>
            <div class="col-md-6 mb-4">
                <label for="kota" class="mb-1">Kota</label>
                <input type="text" class="form-control custom_validation" name="pendidikan[kota][]"
                    placeholder="Contoh: Kendari">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="tahunMasuk" class="mb-1">Tahun Masuk</label>
                <input type="text" class="form-control custom_validation" name="pendidikan[tahun_masuk][]"
                    placeholder="Contoh: 2018">
            </div>
            <div class="col-md-6 mb-4">
                <label for="tahunKeluar" class="mb-1">Tahun Keluar</label>
                <input type="text" class="form-control custom_validation" name="pendidikan[tahun_keluar][]"
                    placeholder="Contoh: 2021">
            </div>
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="jurusan" class="mb-1">Jurusan <span class="small text-info">(jika ada)</span></label>
        <input type="text" class="form-control" name="pendidikan[jurusan][]"
            placeholder="Contoh: Teknik Komputer dan Jaringan">
    </div>
</div>
