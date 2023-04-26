@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 70px">
        <div class="col-md-12">
            @include('pages.parts.cv-kerja-data-diri')

            @include('pages.parts.cv-kerja-pendidikan')
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$('#tambahPendidikan').click(function() {
    let konten = `@include('pages.parts.cv-kerja-pendidikan-konten')`;

    $('#cardBodyPendidikan').append(konten)
});


function removePendidikan(elem) {

    let row_pendidikan = $('.remove_pendidikan').length;

    elem.parentElement.remove();
}
</script>
@endsection