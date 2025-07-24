@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Miscellaneous Expenses</h1>
        <p class="text-muted mb-0">Track and manage various school expenses and expenditures.</p>
    </div>

    <div class="add-fees-section">
        <div class="add-fees-header">
            <i class="fas fa-coins me-2"></i>Expense Records
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2">
                <a href="{{ route('misc-expenses.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add Expense
                </a>
                <a href="{{ route('misc-expenses.show', 'trash') }}" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Trash
                </a>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-receipt me-1"></i>{{ count($expenses) }} expense records total</small>
            </div>
        </div>

        <table class="table table-hover misc_expenses_datatable">
            <thead>
                <tr>
                    <th><i class="fas fa-list me-1"></i>Particular</th>
                    <th><i class="fas fa-dollar-sign me-1"></i>Amount</th>
                    <th><i class="fas fa-user me-1"></i>Paid By</th>
                    <th><i class="fas fa-calendar me-1"></i>Payment Date</th>
                    <th class="no-sort"><i class="fas fa-cogs me-1"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $exp)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $exp->particular }}</div>
                        </td>
                        <td>
                            <span class="text-danger fw-bold">₹{{ number_format($exp->amount) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $exp->payment_by }}</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $exp->payment_date }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('misc-expenses.edit', $exp->id) }}" class="btn btn-sm btn-primary" title="Edit Expense">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('misc-expenses.destroy', $exp) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Move to Trash"
                                        onclick="return confirm('Are you sure you want to move this record to trash?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
