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
            <div class="row">
                <div class="col-12" style="margin-bottom: 4.5em">
                    <div class="form-group">
                        <label for="lang" class="mb-2">Bahasa</label>
                        <select name="lang" id="lang" class="form-control" onclick="setLang(this.value)">
                            <option value="id">Bahasa Indonesia</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>
                @foreach ($templates as $key => $template)
                    <div class="col-md-6 text-center wrap-template">
                        <input class="form-check-input" name="template" type="radio" value="{{ $template['id'] }}" id="template{{ $key }}"
                        @if ($template['id'] == 1)
                            checked
                        @endif style="margin-top: -25px; display: none">
                        <div class="form-check" style="padding-left: 0px">
                            <label class="form-check-label" for="template{{ $key }}">
                                <img src="{{ asset(''.$template['image'].'') }}" alt="{{ $template['nama'] }}" class="mb-2 img-fluid border template-image" style="margin-top: -20px">
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">
               <i class="fa fa-times"></i> Close
            </button>
            <button type="button" class="btn btn-primary" onclick="preview()">
                <i class="fa fa-eye"></i> Preview
            </button>
            <button type="button" class="btn btn-success" onclick="download()">
                <i class="fa fa-download"></i> Download
            </button>
        </div>
    </div>
</div>
</div>
