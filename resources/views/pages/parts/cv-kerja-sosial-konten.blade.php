<div class="row">
    <div class="col-md-5 mb-3">
        <label for="sosialMedia" class="mb-1">Nama Sosial Media</label>
        <input type="text" class="form-control custom_validation" name="sosial_media[nama][]" placeholder="Contoh: Github">
    </div>
    <div class="col-md-5 mb-3">
        <label for="link" class="mb-1">Link</label>
        <input type="text" class="form-control custom_validation" name="sosial_media[link][]" placeholder="Contoh: www.github.com/username01">
    </div>
    <div class="col-md-2 mb-3">
        <div class="btn btn-danger mt-4" onclick="removeSosialMedia(this)">
            <i class="fa fa-times"></i>
        </div>
    </div>
</div>