<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ACload extends Model
{
    use HasFactory;
    protected $table = "ac_load";
    protected $fillable = [
        'ac_model',
        'ac_capacity',
        'status',
        'lab_name',
        'lab_id'
    ];
}
