@extends('auth.layouts')
@section('title', 'Forgot Password')
@section('content')

    <div class="auth-header">
        <h1>Reset Password</h1>
        <p>Enter your email to receive a password reset link</p>
    </div>

    <form action="{{ route('password.email') }}" method="POST" id="forgotPasswordForm">
        @csrf

        {{-- Flash Message --}}
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>

            <div class="text-center mb-3">
                <label id="countdownLabel" class="text-muted">
                    <i class="fas fa-clock me-1"></i>Please wait 60 seconds...
                </label>
            </div>

            {{-- Email Input (Initially Hidden) --}}
            <div id="hidden_input" class="mb-3 d-none">
                @include('auth.email-input')
            </div>

            <button type="submit" id="try_again" class="btn btn-auth" disabled>
                <i class="fas fa-redo me-2"></i>Try Again
            </button>

        @else
            {{-- Validation Error --}}
            @error('email')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror

            {{-- Email Input --}}
            <div class="mb-3">
                @include('auth.email-input')
            </div>

            {{-- Submit Button with Spinner --}}
            <button type="submit" class="btn btn-auth" id="submitButton">
                <span id="buttonText">
                    <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                </span>
                <span id="spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
            </button>

            <div class="auth-links">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left me-1"></i>Back to Login
                </a>
            </div>
        @endif
    </form>

    {{-- JS for spinner and countdown --}}
    <script>
        document.getElementById('forgotPasswordForm')?.addEventListener('submit', function () {
            const buttonText = document.getElementById('buttonText');
            const spinner = document.getElementById('spinner');

            if (buttonText && spinner) {
                buttonText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
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
                countdownLabel.innerHTML = `<i class="fas fa-clock me-1"></i>Please wait ${countdown} seconds...`;
                if (countdown <= 0) {
                    clearInterval(interval);
                    tryAgainButton.disabled = false;
                    countdownLabel.innerHTML = '<i class="fas fa-check me-1"></i>You can try again now.';
                    hiddenInput.classList.replace('d-none', 'd-block');
                }
            }, 1000);
        }
    </script>
@endsection