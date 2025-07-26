<label for="forgotEmail" class="form-label">
    <i class="fas fa-envelope me-2"></i>Email Address
</label>
<input type="email"
    name="email"
    class="form-control @error('email') is-invalid @enderror"
    id="forgotEmail"
    value="{{ old('email', session('old_email')) }}"
    placeholder="Enter your email address"
    required>
