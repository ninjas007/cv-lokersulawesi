@if ($order->payment_status == 2 || config('midtrans.is_active') == false)
    <a href="{{ url('order/download') }}?order_id={{ $order->number }}&snap_token={{ $order->snap_token }}"
        class="btn btn-primary" target="_blank">
        <i class="fa fa-download"></i> Download PDF
    </a>
@elseif ($order->payment_status == 3 && $order->payment_status == 4)
    <a href="{{ url('/cv-kerja') }}" title="Kembali" class="btn btn-danger"><i class="fa fa-times"></i> Kembali</a>
@else
    <button class="btn btn-success" id="bayarSekarang" onclick="bayarSekarang()">Bayar Sekarang</button>
@endif
