<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudClass extends UserScopedModel
{
    use HasFactory;

    protected $table = 'stud_classes';

    protected $fillable = ['user_id','class_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_name', 'name');
    }
}
