<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempLog extends Model
{
    use HasFactory;

    protected $table = "temp_log";
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
