@extends('auth.layouts')

@section('content')
    <form class="w-100" action="{{ route('password.update') }}" method="POST">
        @csrf

        <h1 class="text-success text-center">Reset Password</h1>

        {{-- Include the password reset token --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email --}}
        <div class="mb-3">
            <label for="resetEmail" class="form-label">Email address</label>
            <input type="email"
                   name="email"
                   class="form-control success-focus @error('email') is-invalid @enderror"
                   id="resetEmail"
                   value="{{ old('email', $email ?? '') }}"
                   required
                   autofocus>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label for="resetPassword" class="form-label">New Password</label>
            <input type="password"
                   name="password"
                   class="form-control success-focus @error('password') is-invalid @enderror"
                   id="resetPassword"
                   required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label for="resetPasswordConfirmation" class="form-label">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control success-focus"
                   id="resetPasswordConfirmation"
                   required>
        </div>

        <button type="submit" class="btn btn-success w-100">Reset Password</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-success text-decoration-none">Back to Login</a>
        </div>
    </form>
@endsection
