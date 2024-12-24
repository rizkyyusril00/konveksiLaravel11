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
        'penjahit_id',
        'pemotong_id',
        'size',
        'jumlah_potong',
        'harga_satuan',
        'total_harga',
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

    // Event model
    protected static function booted()
    {
        // Ketika order dibuat
        static::created(function ($order) {
            $order->penjahit->updateTotalOrder();
            $order->pemotong->updateTotalOrder();
        });

        // Ketika order dihapus
        static::deleted(function ($order) {
            $order->penjahit->updateTotalOrder();
            $order->pemotong->updateTotalOrder();
        });

        // Ketika order diperbarui
        static::updated(function ($order) {
            // Ambil data lama sebelum diupdate
            $originalPenjahitId = $order->getOriginal('penjahit_id');
            $originalPemotongId = $order->getOriginal('pemotong_id');

            // Jika `penjahit_id` berubah, update total order karyawan lama dan baru
            if ($originalPenjahitId !== $order->penjahit_id) {
                if ($originalPenjahitId) {
                    Karyawan::find($originalPenjahitId)?->updateTotalOrder();
                }
                $order->penjahit?->updateTotalOrder();
            }

            // Jika `pemotong_id` berubah, update total order karyawan lama dan baru
            if ($originalPemotongId !== $order->pemotong_id) {
                if ($originalPemotongId) {
                    Karyawan::find($originalPemotongId)?->updateTotalOrder();
                }
                $order->pemotong?->updateTotalOrder();
            }
        });
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
