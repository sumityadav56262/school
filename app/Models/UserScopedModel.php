<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;;

abstract class UserScopedModel extends Model
{
    protected static function booted()
    {
        if (app()->runningInConsole()) {
            // Skip global scope in Tinker or Artisan commands
            return;
        }

        static::addGlobalScope('user_id', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });
    }
}
