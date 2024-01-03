<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;
    protected $table = "printers";
    protected $fillable = [
        'printer_model',
        'serial_number',
        'status',
        'lab_name',
        'lab_id'
    ];
}
