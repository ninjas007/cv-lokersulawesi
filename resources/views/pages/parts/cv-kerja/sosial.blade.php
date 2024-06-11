<div class="card mb-3">
    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body" id="cardBodySosial">
        @include('pages.parts.cv-kerja.contents.sosial-konten')
    </div>
    <div class="card-footer">
        @include('pages.parts.cv-kerja.btn-add', ['name' => 'Sosial Media / Kontak', 'id' => 'tambahSosialMedia'])
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-secondary previous me-2"><i class="fas fa-angle-left"></i> Back</a>
            <a class="btn btn-info next" data-part="social">Continue <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
