<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiscExpense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'particular',
        'amount',
        'payment_by',
        'payment_date',
        'remark'
    ];
}
