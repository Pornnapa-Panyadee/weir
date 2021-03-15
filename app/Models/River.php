<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    use HasFactory;

    protected $fillable = [
        'river_id',
        'river_name',
        'river_branch',
        'river_type',
    ];
}
