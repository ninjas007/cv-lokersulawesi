<div class="card-content-form row mt-md-0 mt-sm-4">
    <div class="col-md-4">
        <label for="sosialMedia" class="mb-1">Nama Sosial Media</label>
        <input type="text" class="form-control custom_validation" name="sosial_media[nama][]"
            placeholder="Contoh: Github">
    </div>
    <div class="col-md-5">
        <label for="link" class="mb-1">Link</label>
        <input type="text" class="form-control custom_validation" name="sosial_media[link][]"
            placeholder="Contoh: www.github.com/username01">
    </div>
    <div class="col-md-3 d-flex align-items-center justify-content-start">
        @include('pages.parts.cv-kerja.components.btn-form-inline')
    </div>
</div>
