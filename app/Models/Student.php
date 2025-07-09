<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends UserScopedModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emis_no',
        'class_name',
        'stud_name',
        'roll_no',
        'father_name',
        'mobile_no',
        'address'
    ];

    public function fees()
    {
        return $this->hasMany(StudentFee::class, 'emis_no', 'emis_no');
    }

    public function class()
    {
        return $this->belongsTo(StudClass::class, 'class_name', 'class_name');
    }
}
