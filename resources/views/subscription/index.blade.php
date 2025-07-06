@extends('layout) {{-- Use your main layout file --}}

@section('title', 'My Subscription')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Subscription Details</h2>

    @if($subscription)
        <div class="card">
            <div class="card-body">
                <p><strong>Start Date:</strong> {{ $subscription->start_date->format('F j, Y') }}</p>
                <p><strong>End Date:</strong> {{ $subscription->end_date->format('F j, Y') }}</p>

                @if($subscription->end_date->isPast())
                    <p class="text-danger mt-2">Your subscription has expired.</p>
                    <a href="{{ route('subscription.renew') }}" class="btn btn-warning mt-2">Renew Subscription</a>
                @else
                    <p class="text-success mt-2">Your subscription is active.</p>
                @endif
            </div>
        </div>
    @else
        <p>You do not have an active subscription.</p>
        <a href="{{ route('subscription.renew') }}" class="btn btn-primary mt-2">Subscribe Now</a>
    @endif
</div>
@endsection
