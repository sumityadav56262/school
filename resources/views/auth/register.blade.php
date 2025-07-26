@extends('auth.layouts')
@section('title', 'Register')

@section('content')
    <div class="auth-header">
        <h1>Create Account</h1>
        <p>Join Sapience Academy and start managing your school</p>
    </div>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="fullName" class="form-label">
                <i class="fas fa-user me-2"></i>Full Name
            </label>
            <input type="text" 
                   name="full_name" 
                   class="form-control @error('full_name') is-invalid @enderror" 
                   id="fullName" 
                   value="{{ old('full_name') }}"
                   placeholder="Enter your full name">
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="regEmail" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="regEmail" 
                   value="{{ old('email') }}"
                   placeholder="Enter your email address">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="regPassword" class="form-label">
                <i class="fas fa-lock me-2"></i>Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="regPassword"
                       placeholder="Create a strong password">
                <button type="button" class="password-toggle" id="toggleRegPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="confirmPassword" class="form-label">
                <i class="fas fa-lock me-2"></i>Confirm Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       id="confirmPassword"
                       placeholder="Confirm your password">
                <button type="button" class="password-toggle" id="toggleConfirmPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-auth">
            <i class="fas fa-user-plus me-2"></i>Create Account
        </button>

        <div class="auth-links">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="ms-1">
                <i class="fas fa-sign-in-alt me-1"></i>Sign In
            </a>
        </div>
    </form>
@endsection
