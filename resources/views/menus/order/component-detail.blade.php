@php
    $customer = json_decode($order->customer_details, true);    
@endphp
<table style="width: 100%; margin-top: 100px; margin-bottom: 30px" id="tableDetail">
    <tr>
        <td width="30%">Order ID</td>
        <td width="3%">:</td>
        <td>
            <span id="orderId">{{ $order->number }}</span>
            &nbsp;&nbsp; <span id="copyId" onclick="copyId()"><i class="fa fa-pencil"></i> Copy</span>
        </td>
    </tr>
    <tr>
        <td>Snap Token</td>
        <td width="3%">:</td>
        <td>
            <span>{{ $order->snap_token }}</span>
            &nbsp;&nbsp; <span id="copyId" onclick="copySnap()"><i class="fa fa-pencil"></i> Copy</span>
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $customer['first_name'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>:</td>
        <td>{{ $customer['phone'] ?? '-' }}</td>
    </tr>
    <tr>
        <td>Total (RP)</td>
        <td>:</td>
        <td>{{ number_format($order->total_price) }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td style="text-transform: uppercase">
            {!! $order->attr_payment_status !!}
        </td>
    </tr>
    <tr>
        <td>Tanggal Order</td>
        <td>:</td>
        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="right">
            @if ($order->payment_status == 2)
                <a href="{{ url('download-pdf') }}?order_id={{ $order->number }}&snap_token={{ $order->snap_token }}" class="btn btn-primary">
                    Download PDF
                </a>
            @else
                <button class="btn btn-success" id="bayarSekarang" onclick="bayarSekarang()">Bayar Sekarang</button>
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="3">
            <div class="border p-4">
                Note: <br> <br>
                <ul style="padding-left: 4px">
                    <li class="mb-3">
                        Simpan order id dan snap token diatas untuk melakukan edit pada data yang di inputkan agar tidak dikenakan pembayaran lagi
                    </li>
                    <li class="mb-3">File hanya bisa di download saat sudah berstatus <span class="text-success">Sudah Bayar</span></li>
                    <li class="mb-3">Jika kurang jelas, silahkan contact admin <a href="http://wa.me/6282325576616" target="_blank">082325576616</a></li>
                </ul>
            </div>
        </td>
    </tr>
</table>