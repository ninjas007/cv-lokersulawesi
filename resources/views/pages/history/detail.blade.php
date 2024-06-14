@php
    $customer = json_decode($order->customer_details, true);
    $payload = json_decode($order->payload);
@endphp
<table style="width: 100%;" id="tableDetail">
    <tr>
        <td colspan="3">
            <div class="d-flex justify-content-between">
                <h4>History Order</h4>
            </div>
        </td>
    </tr>
    <tr>
        <td width="30%">
            Order ID &nbsp;<span onclick="copyId(`{{ $order->number }}`)" class="copy text-info"><i class="fa fa-pencil"></i> Copy</span>
        </td>
        <td width="3%">:</td>
        <td>
            <span id="orderId">{{ $order->number }}</span>
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $customer['first_name'] ?? $payload->nama }}</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>:</td>
        <td>{{ $customer['phone'] ?? $payload->no_hp }}</td>
    </tr>
    <tr>
        <td>Total Bayar (Rp)</td>
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
        <td>Limit Edit</td>
        <td>:</td>
        <td>{{ $order->limit_edit }}</td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="right">
            <a href="javascript:void(0)" class="btn btn-info" onclick="loadDataForm(`{{ $order->number }}`)">
                <i class="fa fa-pencil"></i> Edit Form
            </a>
            @include('pages.parts.cv-kerja.btn-checkout', ['order' => $order])
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
                        Simpan order id diatas untuk melakukan edit pada data yang di inputkan agar tidak
                        dikenakan pembayaran lagi
                    </li>
                    <li class="mb-3">File hanya bisa di download saat sudah berstatus <span class="text-success">Sudah
                            Bayar</span></li>
                    <li class="mb-3">Jika kurang jelas, silahkan <a href="http://wa.me/6282389097065" target="_blank"
                            class="text-success font-weight-bold">Whatsapp Admin 082389097065</a></li>
                </ul>
            </div>
        </td>
    </tr>
</table>
