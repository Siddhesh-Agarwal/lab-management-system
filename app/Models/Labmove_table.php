<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labmove_table extends Model
{
    use HasFactory;

    protected $table = "labmove__name";
    protected $fillable = [
        'device_name',
        'spec',
        'system_number',
        'desc',
        'source',
        'destination',
        'lab_id'
    ];
}
