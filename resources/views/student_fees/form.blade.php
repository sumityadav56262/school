<div class="form-row">
    <div class="form-group">
        <label for="emis_no">EMIS No:</label>
        <input type="number" name="emis_no" id="emis_no" value="{{ old('emis_no', $studentFee->emis_no ?? '') }}">
    </div>
    <div class="form-group">
        <label for="paid_date">Date:</label>
        <input type="text" name="paid_date" id="paid_date" readonly
            value="{{ old('paid_date', $studentFee->paid_date ?? $todayFormattedBsDate) }}" disabled>
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <label for="class_name">Class:</label>
        <select name="class_name">
            @foreach ($classNames as $className)
                <option value="{{ $className->class_name }}"> {{ $className->class_name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="roll_no">Roll No:</label>
        <input type="number" name="roll_no" id="roll_no" value="{{ old('roll_no', $studentFee->roll_no ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <div class="form-group">
            <label for="sname">Full Name:</label>
            <input type="text" name="sname" id="sname" value="{{ old('sname', $studentFee->sname ?? '') }}"
                disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="adm_date">Adm. Date:</label>
        <input class="datepicker-here" type="text" data-language="nep"
            value="{{ old('adm_date', $studentFee->adm_date ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="month_name">Month:</label>
        <select name="month_name" id="month_name">
            @foreach (['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'] as $month)
                <option value="{{ $month }}" @selected(old('month_name', $studentFee->month_name ?? '') == $month)>{{ $month }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exam">Exam:</label>
        <input type="number" name="exam" id="exam" value="{{ old('exam', $studentFee->exam ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="yearly">Yearly:</label>
        <input type="number" name="yearly" id="yearly" value="{{ old('yearly', $studentFee->yearly ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="monthly">Monthly:</label>
        <input type="number" name="monthly" id="monthly" value="{{ old('monthly', $studentFee->monthly ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="vest">Vest:</label>
        <input type="number" name="vest" id="vest" value="{{ old('vest', $studentFee->vest ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="tb">TB:</label>
        <input type="number" name="tb" id="tb" value="{{ old('tb', $studentFee->tb ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="eca">ECA:</label>
        <input type="number" name="eca" id="eca" value="{{ old('eca', $studentFee->eca ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="computer">Computer:</label>
        <input type="number" name="computer" id="computer" value="{{ old('computer', $studentFee->computer ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="game">Game:</label>
        <input type="number" name="game" id="game" value="{{ old('game', $studentFee->game ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="trouser">Trouser:</label>
        <input type="number" name="trouser" id="trouser" value="{{ old('trouser', $studentFee->trouser ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="misc_fee">Misc Fee:</label>
        <input type="number" name="misc_fee" id="misc_fee"
            value="{{ old('misc_fee', $studentFee->misc_fee ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="previous-dues-checkbox">Previous Dues</label>
        <input type="number" value="0" disabled>
    </div>
</div>

<hr>

<div class="form-row">
    <div class="form-group">
        <label for="total_amt">Total:</label>
        <input type="number" name="total_amt" id="total_amt" disabled
            value="{{ old('total_amt', $studentFee->game ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="payment">Payment:</label>
        <input type="number" name="payment" id="payment"
            value="{{ old('payment', $studentFee->payment ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="discount">Discount:</label>
        <input type="number" name="discount" id="discount"
            value="{{ old('discount', $studentFee->discount ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="dues">Dues:</label>
        <input type="number" name="dues" id="dues" value="{{ old('dues', $studentFee->dues ?? 0) }}"
            disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="payment_by">Payment By:</label>
        <input type="text" name="payment_by" id="payment_by"
            value="{{ old('payment_by', $studentFee->payment_by ?? '') }}">
    </div>
    <div class="form-group">
        <label for="received_by">Received By:</label>
        <input type="text" name="received_by" id="received_by"
            value="{{ old('received_by', $studentFee->received_by ?? '') }}">
    </div>
</div>
