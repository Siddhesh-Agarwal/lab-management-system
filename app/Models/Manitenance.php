<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manitenance extends Model
{
    use HasFactory;

    protected $table = "maintenance";
    protected $fillable = [
        'device_name',
        'serial_number',
        'system_model_number',
        'count',
        'desc',
        'lab_name',
        'lab_id'
    ];

    const CREATED_AT = 'moved_time';
    const UPDATED_AT = 'returned_time';
}
