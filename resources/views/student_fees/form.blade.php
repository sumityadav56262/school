
<div class="form-row">
    <div class="form-group">
        <label for="class_name">Class:</label>
        <input type="text" name="class_name" id="class_name" value="{{ old('class_name', $studentFee->class_name ?? '') }}">
    </div>
    <div class="form-group">
        <label for="roll_no">Roll No:</label>
        <input type="number" name="roll_no" id="roll_no" value="{{ old('roll_no', $studentFee->roll_no ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="adm_date">Adm. Date:</label>
        <input type="text" name="adm_date" id="adm_date" value="{{ old('adm_date', $studentFee->adm_date ?? '') }}">
    </div>
    <div class="form-group">
        <label for="paid_date">Date:</label>
        <input type="text" name="paid_date" id="paid_date" value="{{ old('paid_date', $studentFee->paid_date ?? date('Y-m-d')) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="month_name">Month:</label>
        <select name="month_name" id="month_name">
            @foreach(['Baisakh','Jestha','Asar','Shrawan','Bhadra','Ashwin','Kartik','Mangsir','Poush','Magh','Falgun','Chaitra'] as $month)
                <option value="{{ $month }}" @selected(old('month_name', $studentFee->month_name ?? '') == $month)>{{ $month }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exam">Exam:</label>
        <input type="text" name="exam" id="exam" value="{{ old('exam', $studentFee->exam ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="yearly">Yearly:</label>
        <input type="number" name="yearly" id="yearly" value="{{ old('yearly', $studentFee->yearly ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="tb">TB:</label>
        <input type="text" name="tb" id="tb" value="{{ old('tb', $studentFee->tb ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="monthly">Monthly:</label>
        <input type="number" name="monthly" id="monthly" value="{{ old('monthly', $studentFee->monthly ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="vest">Vest:</label>
        <input type="text" name="vest" id="vest" value="{{ old('vest', $studentFee->vest ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="eca">ECA:</label>
        <input type="number" name="eca" id="eca" value="{{ old('eca', $studentFee->eca ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="computer">Computer:</label>
        <input type="text" name="computer" id="computer" value="{{ old('computer', $studentFee->computer ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="game">Game:</label>
        <input type="text" name="game" id="game" value="{{ old('game', $studentFee->game ?? '') }}">
    </div>
    <div class="form-group">
        <label for="trouser">Trouser:</label>
        <input type="text" name="trouser" id="trouser" value="{{ old('trouser', $studentFee->trouser ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="misc_fee">Misc Fee:</label>
        <input type="text" name="misc_fee" id="misc_fee" value="{{ old('misc_fee', $studentFee->misc_fee ?? '') }}">
    </div>
    <div class="form-group">
        <label for="previous-dues-checkbox">Previous Dues</label>
        <input type="text" value="0">
    </div>
</div>

<hr>

<div class="form-row">
    <div class="form-group">
        <label for="total_amt">Total:</label>
        <input type="number" name="total_amt" id="total_amt" readonly value="{{ old('total_amt', $studentFee->total_amt ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="discount">Discount:</label>
        <input type="number" name="discount" id="discount" value="{{ old('discount', $studentFee->discount ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="payment">Payment:</label>
        <input type="number" name="payment" id="payment" value="{{ old('payment', $studentFee->payment ?? 0) }}">
    </div>
    <div class="form-group">
        <label for="dues">Dues:</label>
        <input type="number" name="dues" id="dues" value="{{ old('dues', $studentFee->dues ?? 0) }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="payment_by">Payment By:</label>
        <input type="text" name="payment_by" id="payment_by" value="{{ old('payment_by', $studentFee->payment_by ?? '') }}">
    </div>
    <div class="form-group">
        <label for="received_by">Received By:</label>
        <input type="text" name="received_by" id="received_by" value="{{ old('received_by', $studentFee->received_by ?? '') }}">
    </div>
</div>

