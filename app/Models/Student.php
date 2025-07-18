<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends UserScopedModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'emis_no',
        'is_archived',
        'is_active',
        'class_id',
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
        return $this->belongsTo(StudClass::class, 'class_id', 'id')->withTrashed();
    }
    protected static function booted()
    {
        static::deleting(function ($student) {
            if (! $student->isForceDeleting()) {
                $student->fees()->delete(); // soft delete related posts
            } else {
                $student->fees()->forceDelete(); // hard delete
            }
        });

        static::restoring(function ($student) {
            $student->fees()->withTrashed()->restore(); // restore related posts
        });
    }
}
