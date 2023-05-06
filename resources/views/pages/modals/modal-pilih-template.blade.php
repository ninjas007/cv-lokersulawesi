<!-- Modal Pilih Template-->
<div class="modal modal-lg fade" id="modalPilihTemplate" tabindex="-1" aria-labelledby="modalPilihTemplate"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pilihTemplate">Pilih Template</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-5">
                @foreach ($templates as $key => $template)
                    <div class="col-4 text-center">
                        <h4 class="mb-5">{{ $template['nama'] }}</h4>
                        <div class="form-check">
                            <input class="form-check-input" name="template" type="radio" value="{{ $template['id'] }}" id="template{{ $key }}" 
                            @if ($template['id'] == 1)
                                checked
                            @endif>
                            <label class="form-check-label" for="template{{ $key }}">
                                <img src="{{ asset(''.$template['image'].'') }}" alt="{{ $template['nama'] }}" class="mb-2 img-fluid border" style="margin-top: -20px">
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="pakaiTemplate()">
                <i class="fa fa-plus"></i> Pakai Template
            </button>
        </div>
    </div>
</div>
</div>