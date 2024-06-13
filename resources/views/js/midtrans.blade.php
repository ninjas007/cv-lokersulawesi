
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const orderId = `{{ $order->number }}`;
    const snapToken = `{{ $snapToken }}`;

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
