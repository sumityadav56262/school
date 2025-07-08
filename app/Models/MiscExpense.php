<?php

namespace App\Models;

use App\Models\UserScopedModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiscExpense extends UserScopedModel
{
    use HasFactory;

    protected $fillable = [
        'user_id','particular', 'amount', 'payment_by', 'payment_date', 'remark'
    ];
}
