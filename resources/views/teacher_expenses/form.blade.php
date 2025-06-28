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
    </div>
    <div class="form-group">
        <label>Paid Amount:</label>
        <input type="number" name="paid_amt" value="{{ old('paid_amt', $teacherExpense->paid_amt ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Due Amount:</label>
        <input type="number" name="due_amt" value="{{ old('due_amt', $teacherExpense->due_amt ?? 0) }}">
    </div>
    <div class="form-group">
        <label>Paid Date:</label>
        <input type="date" name="paid_date" value="{{ old('paid_date', $teacherExpense->paid_date ?? date('Y-m-d')) }}">
    </div>
</div>
