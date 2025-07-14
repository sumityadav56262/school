@extends('subscription.layouts') {{-- Use your main layout file --}}

@section('title', 'Payment Pending Verification')

@section('content')
<div class="d-flex justify-content-center align-items-center bg-light">
    <div class="card shadow-lg p-5 text-center" style="max-width: 500px; width: 100%;">
        <div class="card-body">
            <i class="fas fa-exclamation-circle fa-3x text-warning mb-4"></i>
            <h2 class="text-danger mb-3">Payment Pending Verification</h2>
            <p class="lead text-muted">Please send your transaction screenshot to our WhatsApp. Your account will be activated after admin approval.</p>
            
            <!-- <a href="{{ route('subscription.renew') }}" class="btn btn-success btn-lg mt-4 px-4">
                <i class="fas fa-sync-alt me-2"></i> Renew Now
            </a> -->
        </div>
    </div>
</div>
@endsection
