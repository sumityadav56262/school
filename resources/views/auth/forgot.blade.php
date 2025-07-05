@extends('auth.layouts')
@section('title', 'Forgot Password')
@section('content')

<form class="w-100" action="{{ route('password.email') }}" method="POST" id="forgotPasswordForm">
    @csrf

    <h1 class="text-success text-center">Forgot Password</h1>

    {{-- Flash Message --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>

        <div class="text-center mb-3">
            <label id="countdownLabel" class="text-muted">Please wait 60 seconds...</label>
        </div>

        {{-- Email Input (Initially Hidden) --}}
        <div id="hidden_input" class="mb-3 d-none">
            @include('auth.email-input')
        </div>

        <button type="submit" id="try_again" class="btn btn-success w-100" disabled>
            Try Again
        </button>

    @else
        {{-- Validation Error --}}
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Email Input --}}
        <div class="mb-3">
            @include('auth.email-input')
        </div>

        {{-- Submit Button with Spinner --}}
        <button type="submit" class="btn btn-success w-100" id="submitButton">
            <span id="buttonText">Send Reset Link</span>
            <span id="spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-success text-decoration-none">Back to Login</a>
        </div>
    @endif
</form>

{{-- JS for spinner and countdown --}}
<script>
    document.getElementById('forgotPasswordForm')?.addEventListener('submit', function () {
        const buttonText = document.getElementById('buttonText');
        const spinner = document.getElementById('spinner');

        if (buttonText && spinner) {
            buttonText.textContent = 'Sending...';
            spinner.classList.remove('d-none');
        }
    });

    const tryAgainButton = document.getElementById('try_again');
    const hiddenInput = document.getElementById('hidden_input');
    const countdownLabel = document.getElementById('countdownLabel');

    if (tryAgainButton && countdownLabel) {
        let countdown = 60;
        const interval = setInterval(() => {
            countdown--;
            countdownLabel.textContent = `Please wait ${countdown} seconds...`;
            if (countdown <= 0) {
                clearInterval(interval);
                tryAgainButton.disabled = false;
                countdownLabel.textContent = 'You can try again now.';
                hiddenInput.classList.replace('d-none', 'd-block');
            }
        }, 1000);
    }
</script>
@endsection