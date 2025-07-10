<div class="form-row">
    <div class="form-group">
        <label for="emis_no">EMIS No:</label>
        <input type="text" name="emis_no" id="emis_no" value="{{ old('emis_no', $studentFee->emis_no ?? '') }}"
            required>
        <input type="button" class="btn btn-success ms-1" id="searchStudByEMISBtn" value="Search">
        @error('emis_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="payment_date">Date:</label>
        <input type="text" name="payment_date" id="payment_date" readonly
            value="{{ old('payment_date', $studentFee->payment_date ?? $nepaliToday) }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="class_name">Class:</label>
        <select name="class_name" id="class_name" required>
            @foreach ($classNames as $className)
                <option value="{{ $className->class_name }}"
                    {{ old('class_name', $studentFee->student->class_name ?? '') === $className->class_name ? 'selected' : '' }}>
                    {{ $className->class_name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="roll_no">Roll No:</label>
        @if (isset($studentFee))
            <input type="number" name="roll_no" id="roll_no" value="{{ $studentFee->student->roll_no }}" required>
        @else
            <input type="number" name="roll_no" id="roll_no" value="{{ old('roll_no') }}" required>
        @endif
        <input type="button" class="btn btn-success ms-1" id="searchStudByClassRollBtn" value="Search">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <div class="form-group">
            <label for="student_name">Full Name:</label>
            @if (isset($studentFee))
                <input type="text" name="student_name" id="student_name"
                    value="{{ $studentFee->student->stud_name }}" disabled required>
            @else
                <input type="text" name="student_name" id="student_name" value="{{ old('student_name') }}" disabled
                    required>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="admission_date">Adm. Date:</label>
        <input class="datepicker-here" type="text" data-language="nep" name="admission_date" id="admission_date"
            value="{{ old('admission_date', $studentFee->admission_date ?? '') }}">
        @error('admission_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="month_name">Month:</label>
        <select name="month_name" id="month_name" required>
            @foreach (['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'] as $month)
                <option value="{{ $month }}" @selected(old('month_name', $studentFee->month_name ?? '') == $month)>{{ $month }}</option>
            @endforeach
        </select>
        @error('month_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exam_fee">Exam:</label>
        <input type="number" name="exam_fee" id="exam_fee" class="fee-field"
            value="{{ old('exam_fee', $studentFee->exam_fee ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="yearly_fee">Yearly:</label>
        <input type="number" name="yearly_fee" id="yearly_fee" class="fee-field"
            value="{{ old('yearly_fee', $studentFee->yearly_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="monthly_fee">Monthly:</label>
        <input type="number" name="monthly_fee" id="monthly_fee" class="fee-field"
            value="{{ old('monthly_fee', $studentFee->monthly_fee ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="vest_fee">Vest:</label>
        <input type="number" name="vest_fee" id="vest_fee" class="fee-field"
            value="{{ old('vest_fee', $studentFee->vest_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="tie_belt_fee">Tie-Belt:</label>
        <input type="number" name="tie_belt_fee" id="tie_belt_fee" class="fee-field"
            value="{{ old('tie_belt_fee', $studentFee->tie_belt_fee ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="eca_fee">ECA:</label>
        <input type="number" name="eca_fee" id="eca_fee" class="fee-field"
            value="{{ old('eca_fee', $studentFee->eca_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="computer_fee">Computer:</label>
        <input type="number" name="computer_fee" id="computer_fee" class="fee-field"
            value="{{ old('computer_fee', $studentFee->computer_fee ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="game_fee">Game:</label>
        <input type="number" name="game_fee" id="game_fee" class="fee-field"
            value="{{ old('game_fee', $studentFee->game_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="trouser_fee">Trouser:</label>
        <input type="number" name="trouser_fee" id="trouser_fee" class="fee-field"
            value="{{ old('trouser_fee', $studentFee->trouser_fee ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="misc_fee">Misc Fee:</label>
        <input type="number" name="misc_fee" id="misc_fee" class="fee-field"
            value="{{ old('misc_fee', $studentFee->misc_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="recurring_dues">Recurring Dues</label>
        <input type="number" value="{{ old('recurring_dues', $studentFee->recurring_dues ?? 0) }}"
            name="recurring_dues" class="recurring_dues" id="recurring_dues" readonly>
        <div class="mx-1">
            <label class="form-check-label" for="addRecuringDues">Add Dues</label>
            <input class="form-check-input" type="checkbox" id="addRecuringDues" name="addRecuringDues">
        </div>
    </div>
</div>

<hr>

<div class="form-row">
    <div class="form-group">
        <label for="total_amt">Total:</label>
        <input type="number" name="total_amt" id="total_amt" disabled
            value="{{ old('total_amt', $studentFee->total_amt ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="payment_amt">Payment:</label>
        <input type="number" name="payment_amt" id="payment_amt"
            value="{{ old('payment_amt', $studentFee->payment_amt ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="discount_amt">Discount:</label>
        <input type="number" name="discount_amt" id="discount_amt"
            value="{{ old('discount_amt', $studentFee->discount_amt ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="dues_amt">Dues:</label>
        <input type="number" name="dues_amt" id="dues_amt"
            value="{{ old('dues_amt', $studentFee->dues_amt ?? 0) }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="payment_by">Payment By:</label>
        <input type="text" name="payment_by" id="payment_by"
            value="{{ old('payment_by', $studentFee->payment_by ?? '') }}" required>
        @error('payment_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="received_by">Received By:</label>
        <input type="text" name="received_by" id="received_by"
            value="{{ old('received_by', $studentFee->received_by ?? '') }}" required>
        @error('received_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
