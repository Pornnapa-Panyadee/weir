<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownconcreteInv extends Model
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
        'flrblock_erosion',
        'flrblock_subsidence',
        'flrblock_cracking',
        'flrblock_obstruction',
        'flrblock_hole',
        'flrblock_leak',
        'flrblock_movement',
        'flrblock_drainage',
        'flrblock_weed',
        'flrblock_damage',
        'flrblock_remake',
        'endsill_erosion',
        'endsill_subsidence',
        'endsill_cracking',
        'endsill_obstruction',
        'endsill_hole',
        'endsill_leak',
        'endsill_movement',
        'endsill_drainage',
        'endsill_weed',
        'endsill_damage',
        'endsill_remake',
    ];
}
