<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emis_no',
        'class_name',
        'payment_date',
        'admission_date',
        'month_name',
        'yearly_fee',
        'eca_fee',
        'game_fee',
        'misc_fee',
        'exam_fee',
        'tie_belt_fee',
        'vest_fee',
        'computer_fee',
        'traouser_fee',
        'total_amt',
        'disc_amt',
        'payment',
        'dues',
        'payment_by',
        'received_by',
        'recurring_dues'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'emis_no', 'emis_no');
    }

    public function class()
    {
        return $this->belongsTo(StudClass::class, 'class_name', 'class_name');
    }
}
