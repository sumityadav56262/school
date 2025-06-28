<div class="form-row">
    <div class="form-group">
        <label>EMIS No</label>
        <input type="text" name="emis_no" value="{{ old('emis_no', $student->emis_no ?? '') }}">
    </div>
    <div class="form-group">
        <label>Student Name</label>
        <input type="text" name="stud_name" value="{{ old('stud_name', $student->stud_name ?? '') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Class</label>
        <input type="text" name="class_name" value="{{ old('class_name', $student->class_name ?? '') }}">
    </div>
    <div class="form-group">
        <label>Roll No</label>
        <input type="number" name="roll_no" value="{{ old('roll_no', $student->roll_no ?? '') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Father Name</label>
        <input type="text" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}">
    </div>
    <div class="form-group">
        <label>Mobile No</label>
        <input type="text" name="mobile_no" value="{{ old('mobile_no', $student->mobile_no ?? '') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', $student->address ?? '') }}">
    </div>
</div>
