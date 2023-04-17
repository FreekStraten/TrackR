<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'pick_ups';

    protected $fillable = [
        'id',
        'pick_up_date_time',
        'pickup_street',
        'pickup_house_number',
        'pickup_city',
        'pickup_zip_code',
        'package_id',
    ];

    public function package()
    {
        return $this->belongsTo(Packet::class);
    }


}
