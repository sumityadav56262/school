<?php

namespace App\Models;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
        'invoice_no',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'emis_no', 'emis_no')->withTrashed();
    }
}
