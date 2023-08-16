<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDevice extends Model
{
    use HasFactory;
    protected $table = "otherdevices";
    protected $fillable = [
        'network_switches',
        'ups_load',
        'ac_load',
        'wifi_access_points',
        'lab_id',
        'lab_name'
    ];
    
}
