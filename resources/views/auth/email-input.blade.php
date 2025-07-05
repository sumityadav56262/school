<label for="forgotEmail" class="form-label">Enter your email address</label>
<input type="email"
    name="email"
    class="form-control success-focus @error('email') is-invalid @enderror"
    id="forgotEmail"
    value="{{ old('email', session('old_email')) }}"
    required>
