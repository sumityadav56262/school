<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudClass extends Model
{
    use HasFactory;

    protected $table = 'stud_classes';

    protected $fillable = ['class_name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}
