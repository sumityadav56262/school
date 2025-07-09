<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user has any subscription record
        $subscription = $user->subscription;

        if (!$subscription) {
            // User has never subscribed, send to renew page
            return redirect()->route('subscription.renew');
        }

        // If user has a subscription, check if it has expired
        if (Carbon::parse($subscription->end_date)->isPast()) {
            return redirect()->route('subscription.expired');
        }

        return $next($request);
    }
}
