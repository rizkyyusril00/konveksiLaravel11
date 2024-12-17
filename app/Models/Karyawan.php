<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'name',
        'pekerjaan',
    ];

    public function ordersAsPenjahit()
    {
        return $this->hasMany(Order::class, 'penjahit_id');
    }

    public function ordersAsPemotong()
    {
        return $this->hasMany(Order::class, 'pemotong_id');
    }
}
