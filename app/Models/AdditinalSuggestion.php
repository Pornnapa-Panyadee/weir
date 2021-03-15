<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditinalSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'suggest_id',
        'weir_id',
        'suggestion'
    ];
}
