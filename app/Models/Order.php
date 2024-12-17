<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer',
        'admin',
        'tanggal_order',
        'tanggal_selesai',
        'jenis_pakaian',
        'jenis_pakaian',
        'bahan_tambahan',
        'jenis_kancing',
        'penjahit',
        'pemotong',
        'size',
        'jumlah_potong',
        'harga_satuan',
        'status',
        'image_order'
    ];

    // Relasi ke tabel karyawans
    public function penjahit()
    {
        return $this->belongsTo(Karyawan::class, 'penjahit_id');
    }

    public function pemotong()
    {
        return $this->belongsTo(Karyawan::class, 'pemotong_id');
    }

    // Accessor untuk tanggal_order
    public function getTanggalOrderAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');  // Format menjadi 16 Des 2024
    }

    // Accessor untuk tanggal_selesai
    public function getTanggalSelesaiAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');  // Format menjadi 16 Des 2024
    }

    public function getTanggalOrderForInput()
    {
        return Carbon::parse($this->attributes['tanggal_order'])->format('Y-m-d');
    }

    public function getTanggalSelesaiForInput()
    {
        return Carbon::parse($this->attributes['tanggal_selesai'])->format('Y-m-d');
    }
}
