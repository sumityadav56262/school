@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Student Fees Management</h1>
        <p class="text-muted mb-0">View and manage student fee records and payments.</p>
    </div>

    <div class="add-fees-section">
        <div class="add-fees-header">
            <i class="fas fa-file-invoice-dollar me-2"></i>Fee Records
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2">
                <a href="{{ route('student-fees.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add Fee Record
                </a>
                <a href="{{ route('student-fees.show', 'trash') }}" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Trash
                </a>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-receipt me-1"></i>{{ count($fees) }} fee records total</small>
            </div>
        </div>

        <table class="table table-hover student_fee_datatable">
            <thead>
                <tr>
                    <th><i class="fas fa-id-card me-1"></i>EMIS</th>
                    <th><i class="fas fa-school me-1"></i>Class</th>
                    <th><i class="fas fa-hashtag me-1"></i>Roll No</th>
                    <th><i class="fas fa-user me-1"></i>Student Name</th>
                    <th><i class="fas fa-calendar me-1"></i>Month</th>
                    <th><i class="fas fa-dollar-sign me-1"></i>Total</th>
                    <th><i class="fas fa-money-bill me-1"></i>Payment</th>
                    <th><i class="fas fa-percentage me-1"></i>Discount</th>
                    {{-- <th><i class="fas fa-exclamation-triangle me-1"></i>Dues</th> --}}
                    <th><i class="fas fa-redo me-1"></i>Rec. Dues</th>
                    <th class="no-sort"><i class="fas fa-cogs me-1"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fees as $fee)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $fee->emis_no }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info text-white">{{ $fee->student->class->class_name ?? 'N/A' }}</span>
                        </td>
                        <td>{{ $fee->student->roll_no ?? 'N/A' }}</td>
                        <td>
                            <div class="fw-semibold">{{ $fee->student->stud_name ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $fee->month_name }}</span>
                        </td>
                        <td>
                            <span class="text-success fw-bold">₹{{ number_format($fee->total_amt) }}</span>
                        </td>
                        <td>
                            <span class="text-primary fw-bold">₹{{ number_format($fee->payment_amt) }}</span>
                        </td>
                        <td>
                            @if ($fee->discount_amt > 0)
                                <span class="text-info fw-bold">₹{{ number_format($fee->discount_amt) }}</span>
                            @else
                                <span class="text-muted">₹0</span>
                            @endif
                        </td>

                        {{-- <td>
                            @if ($fee->dues_amt > 0)
                                <span class="text-danger fw-bold">₹{{ number_format($fee->dues_amt) }}</span>
                            @else
                                <span class="text-success">₹0</span>
                            @endif
                        </td> --}}
                        <td>
                            @if ($fee->recurring_dues > 0)
                                <span class="text-info fw-bold">₹{{ number_format($fee->recurring_dues) }}</span>
                            @else
                                <span class="text-muted">₹0</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('student-fees.show', $fee->id) }}" class="btn btn-sm btn-success"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('student-fees.edit', $fee->id) }}" class="btn btn-sm btn-primary"
                                    title="Edit Fee">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('student-fees.destroy', $fee) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
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
