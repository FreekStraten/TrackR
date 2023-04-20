<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'tracking_number',
        'format',
        'weight',
        'shipping_street',
        'shipping_house_number',
        'shipping_city',
        'shipping_zip_code',
        'delivery_street',
        'delivery_house_number',
        'delivery_city',
        'delivery_zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryDriver()
    {
        return $this->belongsTo(DeliveryDriver::class);
    }

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }
}
