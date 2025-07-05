@extends('auth.layouts')

@section('content')
    <form class="w-100" action="{{ route('password.email') }}" method="POST">
        @csrf

        <h1 class="text-success text-center">Forgot Password</h1>

        {{-- Flash Message --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation Error --}}
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="forgotEmail" class="form-label">Enter your email address</label>
            <input type="email"
                   name="email"
                   class="form-control success-focus @error('email') is-invalid @enderror"
                   id="forgotEmail"
                   value="{{ old('email') }}"
                   required>
        </div>

        <button type="submit" class="btn btn-success w-100">Send Reset Link</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-success text-decoration-none">Back to Login</a>
        </div>
    </form>
@endsection
