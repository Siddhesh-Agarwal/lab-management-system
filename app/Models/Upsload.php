<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upsload extends Model
{
    use HasFactory;
    protected $table = "ups_load";
    protected $fillable = [
        'ups_model',
        'ups_capacity',
        'no_batteries',
        'status',
        'lab_name',
        'lab_id'
    ];
}
