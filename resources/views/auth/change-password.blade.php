@extends('auth.layouts')
@section('title', 'Change Password')
@section('content')
    <form class="w-100" action="{{ route('password.update') }}" method="POST">
        @csrf

        <h1 class="text-success text-center">Change Password</h1>

        {{-- Success message --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Current Password --}}
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password"
                   name="current_password"
                   class="form-control success-focus @error('current_password') is-invalid @enderror"
                   id="current_password"
                   required>
            @error('current_password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password"
                   name="new_password"
                   class="form-control success-focus @error('new_password') is-invalid @enderror"
                   id="new_password"
                   required>
            @error('new_password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm New Password --}}
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password"
                   name="new_password_confirmation"
                   class="form-control success-focus"
                   id="new_password_confirmation"
                   required>
        </div>

        <button type="submit" class="btn btn-success w-100">Update Password</button>
    </form>
@endsection
