<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'tipe',
        'name',
        'sisa',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
