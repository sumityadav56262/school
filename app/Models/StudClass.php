<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudClass extends Model
{
    use HasFactory;

    protected $table = 'stud_classes';

    protected $fillable = ['class_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_name', 'name');
    }
}
