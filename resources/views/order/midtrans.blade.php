@extends('layouts.app')

@section('css')
    <style>
        table tr td {
            padding: 8px 3px !important;
        }

        .copy:hover {
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center bg-white mx-0" style="margin-bottom: 70px">
            <div class="col-12">
                <div id="resultJson">
                    @include('order.component-detail')
                </div>
            </div>
        </div>
    </div>

    @include('pages.modals.modal-pilih-template')
@endsection

@section('js')
    @include('js.copy')

    @include('js.midtrans', [
        'snapToken' => $snapToken,
        'order' => $order
    ])

    <script type="text/javascript">
        function copyId() {
            copyToClipboard(orderId)
        }

        function copySnap() {
            copyToClipboard(snapToken);
        }
    </script>
@endsection
