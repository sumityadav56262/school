@extends('subscription.layouts')

@section('title', 'Renew Subscription')

@section('content')
<div class="py-5">
    <h2 class="text-center mb-5 text-primary">Choose Your Plan</h2>

    <div class="d-flex gap-2 justify-content-center">
        {{-- Free Trial Card --}}
        <div class="shadow col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Free Trial</h5>
                    <p class="card-text">Enjoy 30 days of free access. No payment required.</p>
                    <h4 class="text-muted">
                        <del class="text-muted">NPR 0</del> <br>
                        <strong class="text-dark">Free</strong>
                    </h4>
                    <a href="{{ route('subscription.startTrial') }}" class="btn btn-outline-success mt-3">Start Trial</a>
                </div>
            </div>
        </div>

        {{-- 1 Month Plan --}}
        <div class="shadow col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">1 Month</h5>
                    <p class="card-text">SAve 0% - But Perfect for short-term use.</p>
                    <h4>
                        <del class="text-muted">NPR 0</del> <br>
                        <strong>NPR 200</strong>
                    </h4>
                    <a href="{{ route('subscription.purchase', ['months' => 1]) }}" class="btn btn-primary mt-3">Subscribe</a>
                </div>
            </div>
        </div>

        {{-- 6 Month Plan (10% off) --}}
        <div class="shadow col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">6 Months</h5>
                    <p class="card-text">Save 10% – Best for regular users.</p>
                    <h4>
                        <del class="text-muted">NPR 1,200</del> <br>
                        <strong>NPR 1,080</strong>
                    </h4>
                    <a href="{{ route('subscription.purchase', ['months' => 6]) }}" class="btn btn-warning mt-3 text-white">Subscribe</a>
                </div>
            </div>
        </div>

        {{-- 12 Month Plan (20% off) --}}
        <div class="shadow col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">1 Year</h5>
                    <p class="card-text">Save 20% – Best value for long term.</p>
                    <h4>
                        <del class="text-muted">NPR 2,400</del> <br>
                        <strong>NPR 1,920</strong>
                    </h4>
                    <a href="{{ route('subscription.purchase', ['months' => 12]) }}" class="btn btn-danger mt-3">Subscribe</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
