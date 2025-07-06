<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function expired()
    {
        return view('subscription.expired');
    }

    public function index()
    {
        $subscription = Auth::user()->subscription;
        return view('subscription.index', compact('subscription'));
    }

    public function renew(Request $request)
    {
        $request->validate([
            'months' => 'required|integer|min:1|max:12'
        ]);

        $user = User::class(Auth::user());
        $current = $user->subscription;
        
        $startDate = $current && $current->end_date > now() ? $current->end_date : now();
        $endDate = $startDate->copy()->addMonths($request->months);

        $user->subscription()->updateOrCreate([], [
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        return redirect()->route('dashboard')->with('success', 'Subscription renewed!');
    }
    public function startTrial()
    {
        $user = Auth::user();

        // Prevent multiple trials
        if (Subscriptions::where('user_id', $user->id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'Trial already used.');
        }

        Subscriptions::create([
            'user_id' => $user->id,
            'plan_name' => 'Free Trial',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'active',
            'price' => 0,
            'paid_via' => 'free',
            'transaction_id' => 'TRIAL-' . uniqid(),
            'remarks' => 'Free trial subscription',
        ]);

        return redirect()->route('dashboard')->with('status', 'Free trial started!');
    }

    public function purchase($months)
    {
        $user = Auth::user();

        $pricePerMonth = 200;
        $total = $pricePerMonth * $months;

        // Apply discounts
        if ($months == 6) {
            $total *= 0.90; // 10% off
        } elseif ($months == 12) {
            $total *= 0.80; // 20% off
        }

        Subscriptions::create([
            'user_id' => $user->id,
            'plan_name' => "{$months} Month Plan",
            'start_date' => now(),
            'end_date' => now()->addMonths($months),
            'status' => 'active',
            'price' => $total,
            'paid_via' => 'manual', // or eSewa/Khalti later
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'remarks' => "Manual subscription for {$months} months",
        ]);

        return redirect()->route('dashboard')->with('status', 'Subscription purchased successfully.');
    }
}
