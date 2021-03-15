<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImprovementPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'weir_id',
        'plan_year_check',
        'plan_year',
        'plan_type',
        'plan_budget',
        'proj_budget_check',
        'proj_budget',
        'proj_type',
        'plan_improve',
        'plan_no',
    ];
}
