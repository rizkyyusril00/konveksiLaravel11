<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = [
        'invoice',
        'name_supplier',
        'name',
        'tanggal_pembelian',
        'tanggal_tempo',
        'jumlah',
        'bayar',
        'hutang',
        'status',
    ];
}
