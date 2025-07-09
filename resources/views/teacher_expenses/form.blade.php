<div class="form-row">
    <div class="form-group">
        <label>ID Card No:</label>
        <input type="number" name="id_card_no" id="id_card_no"
            value="{{ old('id_card_no', $teacherExpense->id_card_no ?? '') }}" required>
        @error('id_card_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="datepicker-here">Paid Date:</label>
        <input class="datepicker-here" type="text" data-language="nep" name="paid_date"
            value="{{ old('paid_date', $teacherExpense->paid_date ?? $nepaliToday) }}" required>
        @error('paid_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Teacher:</label>
        <select name="teacher_name" id="teacher_name">
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->teacher_name }}" @selected(old('teacher_name', $teacherExpense->teacher->teacher_name ?? '') == $teacher->teacher_name)>
                    {{ $teacher->teacher_name }}
                </option>
            @endforeach
        </select>
        @error('teacher_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Salary Amount:</label>
        <input type="number" name="salary_amt" class="salary_amt"
            value="{{ old('salary_amt', $teacherExpense->salary_amt ?? '') }}" required>
        @error('salary_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Paid Amount:</label>
        <input type="number" class="paid_amt" name="paid_amt"
            value="{{ old('paid_amt', $teacherExpense->paid_amt ?? 0) }}" required>
        @error('paid_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Due Amount:</label>
        <input type="number" name="due_amt" id="due_amt" value="{{ old('due_amt', $teacherExpense->due_amt ?? 0) }}"
            readonly>
        @error('due_amt')
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
