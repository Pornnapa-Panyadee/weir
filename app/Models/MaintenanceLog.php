<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'maintain_id',
        'weir_id',
        'maintain_date',
        'maintain_detail',
        'maintain_resp',
        'maintain_remark',
    ];
}
