<div class="form-row">
    <div class="form-group">
        <label>Teacher:</label>
        <select name="teacher_id">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" @selected(old('teacher_id', $teacherExpense->teacher_id ?? '') == $teacher->id)>
                    {{ $teacher->teacher_name }}
                </option>
            @endforeach
        </select>
        @error('teacher_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>ID Card No:</label>
        <input type="number" name="id_card_no" value="{{ old('id_card_no', $teacherExpense->id_card_no ?? '') }}">
        @error('id_card_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Salary Amount:</label>
        <input type="number" name="salary_amout" value="{{ old('salary_amout', $teacherExpense->salary_amout ?? '') }}">
        @error('salary_amout')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Paid Amount:</label>
        <input type="number" name="paid_amt" value="{{ old('paid_amt', $teacherExpense->paid_amt ?? 0) }}">
        @error('paid_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Due Amount:</label>
        <input type="number" name="due_amt" value="{{ old('due_amt', $teacherExpense->due_amt ?? 0) }}">
        @error('due_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Paid Date:</label>
        <input type="date" name="paid_date" value="{{ old('paid_date', $teacherExpense->paid_date ?? date('Y-m-d')) }}">
        @error('paid_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Paid By:</label>
        <input type="text" name="paid_by" value="{{ old('paid_by', $teacherExpense->paid_by ?? '') }}">
        @error('paid_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Remark:</label>
        <input type="text" name="remark" value="{{ old('remark', $teacherExpense->remark ?? '') }}">
        @error('remark')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
