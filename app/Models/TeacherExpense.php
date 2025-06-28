<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_card_no', 'salary_amout', 'paid_amt', 'due_amt',
        'paid_by', 'paid_date', 'remark'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_card_no', 'id_card_no');
    }
}
