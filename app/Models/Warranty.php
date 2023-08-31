<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
    protected $table = "warranty";

    protected $fillable = [
        'warranty_name',
        'system_number',
        'time_period',
        'labname',

    ];
}
