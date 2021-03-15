<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeirSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'weir_id',
        'weir_code',
        'weir_name',
        'river_id',
        'weir_spec_id',
        'weir_location_id',
        'weir_build',
        'weir_age',
        'weir_model',
        'resp_name',
        'transfer',
        'user'
    ];
        
}
