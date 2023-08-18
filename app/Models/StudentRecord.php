<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    protected $table = "students_record";

    protected $fillable = [
        'name',
        'email',
        'regNo',
        'degree',
        'branch',
        'pic',
    ];
}
