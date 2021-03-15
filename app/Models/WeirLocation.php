<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeirLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'weir_location_id',
        'utm',
        'latlong',
        'weir_village',
        'weir_tumbol',
        'weir_district',
        'weir_province', 
    ];
}
