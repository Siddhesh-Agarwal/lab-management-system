<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = [
        'name',
        'degree',
        'branch',
        'rollno',
        'isLoggedIn',
        'systemNumber',
        'labname',
        'pic',
    ];
}
