<div class="form-row">
    <div class="form-group">
        <label>Class Name:</label>
        <input type="text" name="class_name" value="{{ old('class_name', $studClass->class_name ?? '') }}" required>
        @error('class_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
