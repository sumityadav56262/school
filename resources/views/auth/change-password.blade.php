@extends('auth.layouts')
@section('title', 'Change Password')
@section('content')
    <div class="auth-header">
        <h1>Change Password</h1>
        <p>Update your account password</p>
    </div>

    <form action="{{ route('password.change.update') }}" method="POST">
        @csrf

        {{-- Success message --}}
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>
        @endif

        {{-- Current Password --}}
        <div class="mb-3">
            <label for="current_password" class="form-label">
                <i class="fas fa-lock me-2"></i>Current Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="current_password"
                       class="form-control @error('current_password') is-invalid @enderror"
                       id="current_password"
                       required
                       placeholder="Enter your current password">
                <button type="button" class="password-toggle" id="toggleCurrentPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label for="new_password" class="form-label">
                <i class="fas fa-lock me-2"></i>New Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="new_password"
                       class="form-control @error('new_password') is-invalid @enderror"
                       id="new_password"
                       required
                       placeholder="Enter your new password">
                <button type="button" class="password-toggle" id="toggleNewPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm New Password --}}
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">
                <i class="fas fa-lock me-2"></i>Confirm New Password
            </label>
            <div class="password-input-group">
                <input type="password"
                       name="new_password_confirmation"
                       class="form-control"
                       id="new_password_confirmation"
                       required
                       placeholder="Confirm your new password">
                <button type="button" class="password-toggle" id="toggleConfirmNewPasswordIcon">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-auth">
            <i class="fas fa-key me-2"></i>Update Password
        </button>
    </form>

    <script>
        // Initialize password toggles for change password form
        document.addEventListener('DOMContentLoaded', function() {
            setupPasswordToggle('current_password', 'toggleCurrentPasswordIcon');
            setupPasswordToggle('new_password', 'toggleNewPasswordIcon');
            setupPasswordToggle('new_password_confirmation', 'toggleConfirmNewPasswordIcon');
        });
    </script>
@endsection
