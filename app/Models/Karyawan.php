<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'name',
        'pekerjaan',
        'upah',
    ];

    public function ordersAsPenjahit()
    {
        return $this->hasMany(Order::class, 'penjahit_id');
    }

    public function ordersAsPemotong()
    {
        return $this->hasMany(Order::class, 'pemotong_id');
    }

    // Method untuk menghitung total order
    public function totalOrder($bulan = null, $tahun = null)
    {
        $penjahitOrders = $this->ordersAsPenjahit();
        $pemotongOrders = $this->ordersAsPemotong();

        if ($bulan) {
            $penjahitOrders->whereMonth('tanggal_order', $bulan);
            $pemotongOrders->whereMonth('tanggal_order', $bulan);
        }

        if ($tahun) {
            $penjahitOrders->whereYear('tanggal_order', $tahun);
            $pemotongOrders->whereYear('tanggal_order', $tahun);
        }

        return $penjahitOrders->count() + $pemotongOrders->count();
    }

    // Update total order setelah ada perubahan
    public function updateTotalOrder()
    {
        $this->total_order = $this->totalOrder();
        $this->save();
    }
}
