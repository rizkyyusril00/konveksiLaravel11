<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'no_hp',
        'email',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
