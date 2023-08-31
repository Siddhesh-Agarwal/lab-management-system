<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManitenanceLogs extends Model
{
    use HasFactory;
    protected $table = "maintenance_log";
    protected $fillable = [
        'device_name',
        'serial_number',
        'system_model_number',
        'count',
        'desc',
        'lab_name',
        'lab_id',
        'moved_time',
        'returned_time'
    ];
}

