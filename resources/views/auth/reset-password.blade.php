@extends('auth.layouts')
@section('title', 'Reset Password')
@section('content')
    <div class="auth-header">
        <h1>Set New Password</h1>
        <p>Enter your new password to complete the reset</p>
    </div>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        {{-- Include the password reset token --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email --}}
        <div class="mb-3">
            <label for="resetEmail" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="resetEmail"
                   value="{{ old('email', $email ?? '') }}"
                   required
                   autofocus
                   placeholder="Enter your email address">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label for="resetPassword" class="form-label">
                <i class="fas fa-lock me-2"></i>New Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="resetPassword"
                       required
                       placeholder="Enter your new password">
                <button type="button" class="password-toggle" id="toggleResetPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label for="resetPasswordConfirmation" class="form-label">
                <i class="fas fa-lock me-2"></i>Confirm Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       id="resetPasswordConfirmation"
                       required
                       placeholder="Confirm your new password">
                <button type="button" class="password-toggle" id="toggleResetConfirmPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-auth">
            <i class="fas fa-key me-2"></i>Reset Password
        </button>

        <div class="auth-links">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left me-1"></i>Back to Login
            </a>
        </div>
    </form>

    <script>
        // Initialize password toggles for reset password form
        document.addEventListener('DOMContentLoaded', function() {
            setupPasswordToggle('resetPassword', 'toggleResetPasswordIcon');
            setupPasswordToggle('resetPasswordConfirmation', 'toggleResetConfirmPasswordIcon');
        });
    </script>
@endsection
