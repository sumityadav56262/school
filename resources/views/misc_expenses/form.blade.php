<div class="form-row">
    <div class="form-group">
        <label>Particular:</label>
        <input type="text" class="form-control" name="particular"
            value="{{ old('particular', $miscExpense->particular ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Payment Date:</label>
        <input type="text" name="payment_date" id="nepali-datepicker"
            value="{{ old('payment_date', $miscExpense->payment_date ?? $nepaliToday) }}" required>
    </div>
</div>

<div class="form-row">
    <div class="form-grow form-group-end">
        @error('particular')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-grow form-group-end">
        @error('payment_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label>Amount:</label>
        <input type="number" class="form-control" name="amount" value="{{ old('amount', $miscExpense->amount ?? 0) }}"
            required>
    </div>
    <div class="form-group">
        <label>Payment By:</label>
        <input type="text" class="form-control" name="payment_by"
            value="{{ old('payment_by', $miscExpense->payment_by ?? '') }}" required>
    </div>
</div>

<div class="form-row">
    <div class="form-grow form-group-end">
        @error('amount')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-grow form-group-end">
        @error('payment_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
