<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkSwitch extends Model
{
    use HasFactory;
    protected $table = "network_switches";
    protected $fillable = [
        'switch_model',
        'serial_number',
        'status',
        'lab_name',
        'lab_id'
    ];
}
