<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'no_hp',
        'alamat',
        'email',
        'bahan_utama',
        'bahan_tambahan',
        'jenis_kancing',
        'jenis_sleting',
    ];
}
