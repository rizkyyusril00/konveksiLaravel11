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
    public function totalOrder()
    {
        return $this->ordersAsPenjahit()->count() + $this->ordersAsPemotong()->count();
    }

    // Update total order setelah ada perubahan
    public function updateTotalOrder()
    {
        $this->total_order = $this->totalOrder();
        $this->save();
    }
}
