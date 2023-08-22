<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $table = "log_details";

    protected $fillable = [
        'rollno',
        'labname',
        'random',
        'login_time',
        'logout_time',
        'system_number',
    ];
    
    const CREATED_AT = 'login_time';
    const UPDATED_AT = 'logout_time';

}
