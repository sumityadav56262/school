<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudClass extends UserScopedModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'stud_classes';

    protected $fillable = ['user_id', 'class_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($studentClass) {
            if (! $studentClass->isForceDeleting()) {
                foreach ($studentClass->students as $student) {
                    $student->delete(); // Triggers Student::deleting event, soft-deleting fees
                }
            } else {
                foreach ($studentClass->students()->withTrashed()->get() as $student) {
                    $student->forceDelete(); // Triggers force delete
                }
            }
        });

        static::restoring(function ($studentClass) {
            foreach ($studentClass->students()->withTrashed()->get() as $student) {
                $student->restore(); // Triggers restore for fees too
            }
        });
    }
}
