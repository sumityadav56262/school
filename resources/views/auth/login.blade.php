@extends('auth.layouts')
@section('title', 'Login')
@section('content')
    <div class="auth-header">
        <h1>Welcome Back</h1>
        <p>Sign in to your Sapience Academy account</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Show general error (like invalid credentials) --}}
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first('email') }}
            </div>
        @elseif(session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="loginEmail" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="loginEmail"
                value="{{ old('email') }}" required autofocus placeholder="Enter your email address">
            {{-- @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror --}}
        </div>

        <div class="mb-3">
            <label for="loginPassword" class="form-label">
                <i class="fas fa-lock me-2"></i>Password
            </label>
            <div class="password-input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="loginPassword" required placeholder="Enter your password">
                <button type="button" class="password-toggle" id="togglePasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            {{-- @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror --}}
        </div>

        <button type="submit" class="btn btn-auth">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
        </button>

        <div class="auth-links">
            <a href="{{ route('password.request') }}">
                <i class="fas fa-key me-1"></i>Forgot your password?
            </a>
        </div>

        {{-- <div class="auth-links mt-2">
            <span class="text-muted">Don't have an account?</span>
            <a href="{{ route('register') }}" class="ms-1">
                <i class="fas fa-user-plus me-1"></i>Create Account
            </a>
        </div> --}}
    </form>
@endsection
