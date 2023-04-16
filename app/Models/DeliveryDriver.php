<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Packet;

class DeliveryDriver extends Model
{
    protected $fillable = [
        'name',
    ];

    public function packets()
    {
        return $this->hasMany(Packet::class);
    }
}
