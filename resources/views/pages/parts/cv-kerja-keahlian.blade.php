<div class="card mb-3">
    <div class="card-header">
        <h4 class="font-weight-bold">
            <i class="fa fa-book"></i> Keahlian
        </h4>
    </div>
    <div class="card-body" id="cardBodyKeahlian">
        <div class="row">
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="type" class="mb-1">Tipe Input</label>
                    <select name="tipe_input" id="tipeInput" class="form-control" onchange="changeTipeInputKeahlian(this)">
                        <option value="text">Text Area</option>
                        <option value="list">List</option>
                    </select>
                </div>
            </div>
        </div>
        @include('pages.parts.cv-kerja-keahlian-konten')
    </div>
    <div class="card-footer" style="display: none">
        <a href="javascript:void(0)" class="form-control btn bg-primary1 text-white" id="tambahKeahlian" onclick="tambahKeahlian()"><i class="fa fa-plus"></i> Tambah
           Keahlian</a>
    </div>
</div>
