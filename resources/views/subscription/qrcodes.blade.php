@extends('subscription.layouts')

@section('title', 'Scan to Pay & Verify')

@section('content')
<div class="container mt-5 text-center">
    <h2 class="mb-4 text-success">Step 1: Scan to Pay via FonePay</h2>
    <img src="{{ asset('images/fonepay-qr.png') }}" alt="FonePay QR" class="img-fluid" style="max-height: 300px;">

    <h2 class="mt-5 mb-4 text-primary">Step 2: Send Screenshot to WhatsApp</h2>
    <img src="{{ asset('images/whatsapp-contact-qr.png') }}" alt="WhatsApp QR" class="img-fluid" style="max-height: 300px;">

    <p class="mt-4">After sending, <a href="{{ route('subscription.pending') }}" class="btn btn-warning mt-2">Click Here to Proceed</a></p>
</div>
@endsection
