<div class="card mb-3">
    @include('pages.parts.cv-kerja.contents.card-title')

    <div class="card-body" id="cardBodyKeahlian">
        <div class="row">
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="type" class="mb-1">Tipe Input</label>
                    <select name="tipe_input_keahlian" id="tipeInput" class="form-control" onchange="changeTipeInputKeahlian(this)">
                        <option value="text">Text Area</option>
                        <option value="list">List</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="tipeTextKeahlian">
            @include('pages.parts.cv-kerja.contents.keahlian-konten-1')
        </div>

        <div id="tipeListKeahlian" style="display: none">
            @include('pages.parts.cv-kerja.contents.keahlian-konten-2')
        </div>
    </div>
    <div class="card-footer" style="display: none">
        @include('pages.parts.cv-kerja.btn-add', [
            'name' => 'Keahlian',
            'id' => 'tambahKeahlian'
        ])
    </div>
</div>

<div class="fixed-bottom-container">
    <div class="container">
        <div class="form-group d-flex justify-content-center">
            <a class="btn btn-secondary previous me-2"><i class="fas fa-angle-left"></i> Back</a>
            <a class="btn btn-info next" data-part="keahlian">Save & Next <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
