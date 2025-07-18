<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends UserScopedModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'id_card_no',
        'teacher_name',
        'designation',
        'mobile_no',
        'address'
    ];

    public function expenses()
    {
        return $this->hasMany(TeacherExpense::class, 'teacher_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($teacher) {
            if (! $teacher->isForceDeleting()) {
                $teacher->expenses()->delete(); // Triggers TeacherExpense::deleting event, soft-deleting expenses
            } else {
                $teacher->expenses()->forceDelete(); // Triggers force delete
            }
        });

        static::restoring(function ($teacher) {
            $teacher->expenses()->restore(); // Triggers restore for fees too
        });
    }
}
