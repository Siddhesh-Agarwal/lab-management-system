<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab_Table extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'lab__tables';
    protected $fillable = [
        'id',
        'lab_name',
        'lab_code',
        'block',
        'room_number',
        'department'
    ];

    public function id()
    {
        return $this->hasOne(Admin::class);
    }
    public function labList()
    {
        return $this->hasMany(LabList::class, 'labid', 'labid');
    }
}
