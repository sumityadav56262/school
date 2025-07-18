@extends('auth.layouts')
@section('title', 'Login')
@section('content')
    <form class="w-100" action="{{ route('login') }}" method="POST">
        @csrf

        <h1 class="text-success text-center">Login</h1>

        {{-- Show general error (like invalid credentials) --}}
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @elseif(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email"
                   name="email"
                   class="form-control success-focus @error('email') is-invalid @enderror"
                   id="loginEmail"
                   value="{{ old('email') }}"
                   required autofocus>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 position-relative">
            <label for="loginPassword" class="form-label">Password</label>
            <div class="input-group">
                <input type="password"
                    name="password"
                    class="form-control success-focus @error('password') is-invalid @enderror"
                    id="loginPassword"
                    required>
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
            </div>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success w-100">Submit</button>

        <div class="text-center mb-2">
            <a class="text-danger text-decoration-none" href="{{route('password.request')}}">Forgot password</a>
        </div>

        <div class="text-center mb-3">
            <a class="text-success text-decoration-none" href="{{ route('register') }}">Register</a>
        </div>
    </form>
@endsection