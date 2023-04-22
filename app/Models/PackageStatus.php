<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $table = 'package_status';

    const CHECKED_IN = 1;
    const PRINTED = 2;
    const DELIVERED_AT_DELIVERY_POINT = 3;
    const SORTER_CENTER = 4;
    const ON_ROUTE_TO_FINAL_DESTINATION = 5;
    const DELIVERED_AT_FINAL_DESTINATION = 6;


    protected $fillable = [
        'name',
        'id',
    ];












}
