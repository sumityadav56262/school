<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiscExpense extends UserScopedModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'particular',
        'amount',
        'payment_by',
        'payment_date',
        'remark'
    ];
}
