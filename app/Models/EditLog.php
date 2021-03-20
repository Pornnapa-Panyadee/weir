<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'weir_id',
        'user',
        'status'
    ];
}
