<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function subscription()
    {
        return $this->hasOne(Subscriptions::class);
    }

    public function stud_class()
    {
        return $this->hasMany(\App\Models\StudClass::class);
    }

    public function students()
    {
        return $this->hasMany(\App\Models\Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(\App\Models\Teacher::class);
    }

    public function studentFees()
    {
        return $this->hasMany(\App\Models\StudentFee::class);
    }

    public function teacherExpenses()
    {
        return $this->hasMany(\App\Models\TeacherExpense::class);
    }

    public function miscExpenses()
    {
        return $this->hasMany(\App\Models\MiscExpense::class);
    }
}
