@extends('auth.layouts')

@section('content')
    <form class="w-100" action="{{ route('register') }}" method="POST">
        @csrf

        <h1 class="text-success text-center">Register</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control success-focus @error('full_name') is-invalid @enderror" id="fullName" value="{{ old('full_name') }}">
            @error('full_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="regEmail" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control success-focus @error('email') is-invalid @enderror" id="regEmail" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="regPassword" class="form-label">New Password</label>
            <input type="password" name="password" class="form-control success-focus @error('password') is-invalid @enderror" id="regPassword">
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control success-focus" id="confirmPassword">
        </div>

        <button type="submit" class="btn btn-success w-100">Submit</button>

        <div class="text-center mt-3">
            <a href="/login" class="text-danger text-decoration-none">Already have an account? Login</a>
        </div>
    </form>
@endsection
