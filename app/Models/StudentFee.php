<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFee extends UserScopedModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emis_no',
        'class_name',
        'payment_date',
        'admission_date',
        'month_name',
        'yearly_fee',
        'monthly_fee',
        'eca_fee',
        'game_fee',
        'misc_fee',
        'exam_fee',
        'tie_belt_fee',
        'vest_fee',
        'computer_fee',
        'trouser_fee',
        'total_amt',
        'discount_amt',
        'payment_amt',
        'dues_amt',
        'payment_by',
        'received_by',
        'recurring_dues',
        'recurring_dues_included_amt'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'emis_no', 'emis_no');
    }
}
