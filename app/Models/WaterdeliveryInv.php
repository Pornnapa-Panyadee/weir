<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterdeliveryInv extends Model
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
        'floor_remake',
        'check_floor',
        
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
        'gate_erosion',
        'gate_subsidence',
        'gate_cracking',
        'gate_obstruction',
        'gate_hole',
        'gate_leak',
        'gate_movement',
        'gate_drainage',
        'gate_weed',
        'gate_damage',
        'gate_remake',
    ];
}
