<div class="card mb-3">

    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body px-3" id="cardBodyPortofolio">
        {{-- @include('pages.parts.cv-kerja.contents.portofolio-konten') --}}
    </div>
    <div class="card-footer">
        @include('pages.parts.cv-kerja.btn-add', ['name' => 'Portofolio', 'id' => 'tambahPortofolio'])
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-danger previous me-2"><i class="fas fa-angle-left"></i> Back</a>
            <a class="btn btn-info me-2"><i class="fas fa-save"></i> Save</a>
            <a class="btn btn-info" onclick="saveDataForm()" data-mdb-toggle="modal" data-mdb-target="#modalPilihTemplate"><i class="fas fa-eye"></i> Preview</a>
        </div>
    </div>
</div>
