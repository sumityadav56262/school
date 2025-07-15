<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends UserScopedModel
{
    use HasFactory;

    protected $fillable = [
        'user_id','id_card_no', 'teacher_name', 'designation', 'mobile_no', 'address'
    ];

    public function expenses()
    {
        return $this->hasMany(TeacherExpense::class, 'teacher_id', 'id');
    }
}
