<div class="form-row">
    <div class="form-group">
        <label>Particular:</label>
        <input type="text" class="form-control" name="particular"
            value="{{ old('particular', $miscExpense->particular ?? '') }}" required>
        @error('particular')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Payment Date:</label>
        <input class="datepicker-here" type="text" data-language="nep" name="payment_date" id="payment_date"
            value="{{ old('payment_date', $miscExpense->payment_date ?? $nepaliToday) }}" required>
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
        @error('amount')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>Payment By:</label>
        <input type="text" class="form-control" name="payment_by"
            value="{{ old('payment_by', $miscExpense->payment_by ?? '') }}" required>
        @error('payment_by')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
