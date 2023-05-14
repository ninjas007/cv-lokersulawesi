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
        <div class="row justify-content-center" style="margin-bottom: 70px">
            <div class="col-12">
                <div id="resultJson" class="p-3">
                    <div class="text-center mt-5">Sedang diarahkan ke pembayaran...</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                const table = `<table style="width: 100%; margin-top: 100px; margin-bottom: 30px">
                                    <tr>
                                        <td width-"30%">Transaksi Status</td>
                                        <td width="3%">:</td>
                                        <td style="text-transform: uppercase">${result.transaction_status}</td>
                                    </tr>
                                    <tr>
                                        <td>Order ID</td>
                                        <td>:</td>
                                        <td><span id="orderId">${result.order_id}</span> <span class="btn btn-primary btn-sm" id="copyId"><i class="fa fa-pencil"></i> Copy</span></td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Time</td>
                                        <td>:</td>
                                        <td>${result.transaction_time}</td>
                                    </tr>
                                    <tr>
                                        <td>Total (RP)</td>
                                        <td>:</td>
                                        <td>${result.gross_amount}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted" colspan="3">
                                            Simpan Order ID untuk mengedit data atau mengungunduh ulang
                                        </td>
                                    </tr>
                                </table>`

                document.getElementById('resultJson').innerHTML = `${table}`;
                document.getElementById('resultJson').innerHTML += `
                    <a class="btn btn-success" href="{{ url('download-pdf') }}?order_id=${result.order_id}&transaction_status=${result.transaction_status}">
                       <i class="fa fa-save"></i> Save pdf
                    <a/>`;


                    ('#copyID').click(function(){ 
                        const copyText = document.getElementById("orderId");

                        // Select the text field
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); // For mobile devices

                        // Copy the text inside the text field
                        navigator.clipboard.writeText(copyText.value);

                        // Alert the copied text
                        alert("Copied the text: " + copyText.value);
                    })

              
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // {
                //     "status_code": "200",
                //     "status_message": "Success, transaction is found",
                //     "transaction_id": "8f13eb16-e0bb-4b42-97b2-e74d7f6338ad",
                //     "order_id": "CVKRJ-0000000001",
                //     "gross_amount": "20000.00",
                //     "payment_type": "bank_transfer",
                //     "transaction_time": "2023-05-07 18:21:20",
                //     "transaction_status": "settlement",
                //     "fraud_status": "accept",
                //     "va_numbers": [
                //         {
                //             "bank": "bca",
                //             "va_number": "99229966278"
                //         }
                //     ],
                //     "bca_va_number": "99229966278",
                //     "pdf_url": "https://app.sandbox.midtrans.com/snap/v1/transactions/c08d7dd9-24f7-4fe3-bfd3-a280f5ea8c69/pdf",
                //     "finish_redirect_url": "http://example.com?order_id=CVKRJ-0000000001&status_code=200&transaction_status=settlement"
                // }

                // console.log(result)
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
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
</script>
@endsection