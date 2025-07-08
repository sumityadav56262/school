<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherExpense extends UserScopedModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_card_no',
        'salary_amout',
        'paid_amt',
        'due_amt',
        'paid_by',
        'paid_date',
        'remark'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_card_no', 'id_card_no');
    }
}
