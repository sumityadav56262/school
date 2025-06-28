<div class="form-row">
    <div class="form-group">
        <label>Particular:</label>
        <input type="text" name="particular" value="{{ old('particular', $miscExpense->particular ?? '') }}">
    </div>
    <div class="form-group">
        <label>Amount:</label>
        <input type="number" name="amount" value="{{ old('amount', $miscExpense->amount ?? 0) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Payment By:</label>
        <input type="text" name="payment_by" value="{{ old('payment_by', $miscExpense->payment_by ?? '') }}">
    </div>
    <div class="form-group">
        <label>Payment Date:</label>
        <input type="date" name="payment_date" value="{{ old('payment_date', $miscExpense->payment_date ?? date('Y-m-d')) }}">
    </div>
</div>
