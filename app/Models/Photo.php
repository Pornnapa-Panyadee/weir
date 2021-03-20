<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'weir_id',
        'photo_type',
        'photo_filename',
        'thumbnall_filename',
    ];
}
