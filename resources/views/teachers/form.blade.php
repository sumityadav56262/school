<div class="form-row">
    <div class="form-group">
        <label>ID Card No:</label>
        <input type="text" name="id_card_no" value="{{ old('id_card_no', $teacher->id_card_no ?? '') }}">
    </div>
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="teacher_name" value="{{ old('teacher_name', $teacher->teacher_name ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Mobile No:</label>
        <input type="text" name="mobile_no" value="{{ old('mobile_no', $teacher->mobile_no ?? '') }}">
    </div>
    <div class="form-group">
        <label>Designation:</label>
        <input type="text" name="designation" value="{{ old('designation', $teacher->designation ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Address:</label>
        <input type="text" name="address" value="{{ old('address', $teacher->address ?? '') }}">
    </div>
</div>
