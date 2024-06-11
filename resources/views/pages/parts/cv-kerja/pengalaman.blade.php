<div class="card mb-3">
    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body" id="cardBodyPengalaman">
        {{-- @include('pages.parts.cv-kerja.contents.pengalaman-konten') --}}
    </div>
    <div class="card-footer">
        @include('pages.parts.cv-kerja.btn-add', ['name' => 'Pengalaman', 'id' => 'tambahPengalaman'])
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-secondary previous me-2"><i class="fas fa-angle-left"></i> Back</a>
            <a class="btn btn-info next">Continue <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
