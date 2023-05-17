<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function getLatestId()
    {
        return $this->latest()->first()->id;
    }

    public function getAttrPaymentStatusAttribute()
    {
        if ($this->payment_status == 2) {
            return '<span class="text-success" style="font-weight: bold">Sudah Bayar</span>';
        } else if ($this->payment_status == 3) {
            return '<span class="text-warning" style="font-weight: bold">Kadaluarsa</span>';
        } else if ($this->payment_status == 4) {
            return '<span class="text-danger" style="font-weight: bold">Batal</span>';
        } else {
            return '<span class="text-primary" style="font-weight: bold">Menunggu Pembayaran</span>';
        }
    }
}
