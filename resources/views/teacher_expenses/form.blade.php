<div class="form-row">
    <div class="form-group">
        <label for="id_card_no">ID Card No:</label>
        <input type="number" name="id_card_no" id="id_card_no"
            value="{{ old('id_card_no', $teacherExpense->teacher->id_card_no ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="paid_date">Paid Date:</label>
        <input type="text" name="paid_date" id="nepali-datepicker"
            value="{{ old('paid_date', $teacherExpense->paid_date ?? $nepaliToday) }}" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group form-group-end">
        @error('id_card_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group form-group-end">
        @error('paid_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="teacher_name">Teacher:</label>
        <select name="teacher_name" id="teacher_name">
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->teacher_name }}" @selected(old('teacher_name', $teacherExpense->teacher->teacher_name ?? '') == $teacher->teacher_name)>
                    {{ $teacher->teacher_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="salary_amt">Salary Amount:</label>
        <input type="number" name="salary_amt" class="salary_amt" id="salary_amt"
            value="{{ old('salary_amt', $teacherExpense->salary_amt ?? '') }}" required>
    </div>
</div>


<div class="form-row">
    <div class="form-group form-group-end">
        @error('teacher_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group form-group-end">
        @error('salary_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="paid_amt">Paid Amount:</label>
        <input type="number" class="paid_amt" name="paid_amt" id="paid_amt"
            value="{{ old('paid_amt', $teacherExpense->paid_amt ?? 0) }}" required>
    </div>

    <div class="form-group">
        <label for="due_amt">Due Amount:</label>
        <input type="number" name="due_amt" id="due_amt" value="{{ old('due_amt', $teacherExpense->due_amt ?? 0) }}"
            readonly>
    </div>
</div>


<div class="form-row">
    <div class="form-group form-group-end">
        @error('paid_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group form-group-end">
        @error('due_amt')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="paid_by">Paid By:</label>
        <input type="text" name="paid_by" id="paid_by"
            value="{{ old('paid_by', $teacherExpense->paid_by ?? '') }}">
    </div>

    <div class="form-group">
        <label for="remark">Remark:</label>
        <input type="text" name="remark" id="remark" value="{{ old('remark', $teacherExpense->remark ?? '') }}"
            required>
    </div>
</div>

<div class="form-row">
    <div class="form-group form-group-end">
        @error('paid_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group form-group-end">
        @error('remark')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
