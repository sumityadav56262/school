<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiscExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'particular', 'amount', 'payment_by', 'payment_date', 'remark'
    ];
}
