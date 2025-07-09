<div class="form-row">
    <div class="form-group">
        <label>EMIS No</label>
        <input type="text" name="emis_no" value="{{ old('emis_no', $student->emis_no ?? '') }}" required>
        @error('emis_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Class</label>
        <select name="class_name" id="class_name" required>
            @foreach ($classNames as $className)
                <option value="{{ $className->class_name }}"
                    {{ old('class_name', $student->class_name ?? '') === $className->class_name ? 'selected' : '' }}>
                    {{ $className->class_name }} </option>
            @endforeach
        </select>
        @error('class_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Student Name</label>
        <input type="text" name="stud_name" value="{{ old('stud_name', $student->stud_name ?? '') }}" required>
        @error('stud_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>Roll No</label>
        <input type="number" name="roll_no" value="{{ old('roll_no', $student->roll_no ?? '') }}" required>
        @error('roll_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Father Name</label>
        <input type="text" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}"
            required>
        @error('father_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>Mobile No</label>
        <input type="text" name="mobile_no" value="{{ old('mobile_no', $student->mobile_no ?? '') }}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', $student->address ?? '') }}" required>
    </div>
</div>
