<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeirSpaceification extends Model
{
    use HasFactory;
    protected $fillable = [
        'weir_spec_id',
        'ridge_type',
        'ridge_height',
        'ridge_width',
        'gate_has',
        'gate_type',
        'gate_dimension',
        'gate_machanic_has',
        'gate_machanic_type',
        'control_building_has',
        'control_building_type',
        'conttrol_building_loc',
        'control_building_gate_has',
        'control_building_gate_type',
        'control_building_gate_dimension',
        'control_building_machanic_type',
        'canal_has',
        'canal_type',
        'canel_dimension',
     ];

   

}
