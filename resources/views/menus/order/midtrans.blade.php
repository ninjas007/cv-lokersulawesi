@extends('layouts.app')

@section('css')
    <style>
        table tr td {
            padding: 8px 3px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center bg-white" style="margin-bottom: 70px">
            <div class="col-12">
                <div id="resultJson" class="p-3">
                    @include('menus.order.component-detail')
                </div>
            </div>
        </div>
    </div>

    @include('pages.modals.modal-pilih-template')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        const orderId = `{{ $order->number }}`;
        const snapToken = `{{ $snapToken }}`;

        function copyToClipboard(text) {
            // Buat elemen sementara untuk menyalin teks
            var $temp = $("<input>");

            // Tambahkan elemen sementara ke dalam dokumen
            $("body").append($temp);

            // Salin teks ke elemen sementara
            $temp.val(text).select();

            // Salin teks ke clipboard
            document.execCommand("copy");

            // Hapus elemen sementara dari dokumen
            $temp.remove();

            swal({
                title: "Sukses",
                text: `Text berhasil di copy: ${text}`,
                icon: "success",
                button: "Ok",
            });
        }

        function copyId() {
            copyToClipboard(orderId)
        }

        function copySnap() {
            copyToClipboard(snapToken);
        }

        function bayarSekarang() {
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    location.reload();
                },
                // Optional
                    onPending: function(result) {
                        alert('pending')
                        console.log(result)
                },
                // Optional
                onError: function(result) {
                    alert('error')
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        }
    </script>
@endsection
