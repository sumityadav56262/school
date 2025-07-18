<div class="form-row">
    <div class="form-group">
        <label>Class Name:</label>
        <input type="text" name="class_name" value="{{ old('class_name', $studClass->class_name ?? '') }}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        @error('class_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
