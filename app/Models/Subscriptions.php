<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriptions extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'start_date',
        'end_date',
        'status',
        'price',
        'paid_via',
        'transaction_id',
        'remarks',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'price'      => 'decimal:2',
    ];

    /**
     * Relationship: Subscription belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
