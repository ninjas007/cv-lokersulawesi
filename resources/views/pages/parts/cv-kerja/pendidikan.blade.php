<div class="card">

    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body" id="cardBodyPendidikan">
        @include('pages.parts.cv-kerja.contents.pendidikan-konten')
    </div>
    <div class="card-footer">
        @include('pages.parts.cv-kerja.btn-add', [
            'name' => 'Pendidikan',
            'id' => 'tambahPendidikan'
        ])
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-danger previous me-2"><i class="fas fa-angle-left"></i> Back</a>
            <a class="btn btn-info next" data-part="pendidikan">Save & Next <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
