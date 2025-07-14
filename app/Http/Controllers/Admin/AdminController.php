<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriptions as Subscription;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::where('is_admin', false)->count();
        $activeSubs = Subscription::where('status', 'active')->count();

        return view('admin.dashboard', compact('userCount', 'activeSubs'));
    }

    public function users()
    {
        $users = User::where('is_admin', false)->with('subscriptions')->get();
        return view('admin.users', compact('users'));
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::with('user')->latest()->get();
        return view('admin.subscriptions', compact('subscriptions'));
    }

    public function extendSubscription(Request $request, $id)
    {
        $request->validate(['months' => 'required|integer|min:1']);

        $subscription = Subscription::findOrFail($id);
        $subscription->end_date = \Carbon\Carbon::parse($subscription->end_date)->addMonths($request->months);
        $subscription->status = 'active';
        $subscription->save();

        return back()->with('success', 'Subscription extended.');
    }

    public function cancelSubscription($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->status = 'cancelled';
        $subscription->save();

        return back()->with('success', 'Subscription cancelled.');
    }

}
