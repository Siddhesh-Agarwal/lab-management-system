<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lablist extends Model
{
    use HasFactory;

    protected $table = "lablists";
    protected $fillable = [
        'device_name',
        'spec',
        'system_number',
        'desc',
        'lab_name',
        'lab_id'
    ];
    public function devices()
    {
        return $this->hasMany(Lab_Table::class, 'lab_name', 'lab_name');
    }
    public function labTable()
    {
        return $this->belongsTo(Lab_Table::class, 'labid', 'labid');
    }
}
