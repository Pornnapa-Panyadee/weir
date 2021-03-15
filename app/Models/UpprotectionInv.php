<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpprotectionInv extends Model
{
    use HasFactory;

    protected $fillable = [
        'weir_id',          
        'floor_erosion',
        'floor_subsidence',
        'floor_cracking',
        'floor_obstruction',
        'floor_hole',
        'floor_leak',
        'floor_movement',
        'floor_drainage',
        'floor_weed',
        'floor_damage',
        'check_floor',
        'floor_remake',
        'side_erosion',
        'side_subsidence',
        'side_cracking',
        'side_obstruction',
        'side_hole',
        'side_leak',
        'side_movement',
        'side_drainage',
        'side_weed',
        'side_damage',
        'side_remake',
    ];
}
