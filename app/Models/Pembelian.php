<?php

namespace App\Models;

use Carbon\Carbon;
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

    // Accessor untuk tanggal_order
    public function getTanggalPembelianAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');  // Format menjadi 16 Des 2024
    }

    // Accessor untuk tanggal_selesai
    public function getTanggalTempoAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');  // Format menjadi 16 Des 2024
    }

    public function getTanggalPembelianForInput()
    {
        return Carbon::parse($this->attributes['tanggal_pembelian'])->format('Y-m-d');
    }

    public function getTanggalTempoForInput()
    {
        return Carbon::parse($this->attributes['tanggal_tempo'])->format('Y-m-d');
    }
}
