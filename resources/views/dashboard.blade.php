@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Dashboard Overview</h1>
        <p class="text-muted mb-0">Welcome back! Here's what's happening at Sapience Academy today.</p>
    </div>

    <div class="c_div mb-5">
        <!-- Total Students -->
        <div class="students c_card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0 fw-semibold">Students</h3>
                <i class="fas fa-user-graduate fa-2x opacity-75"></i>
            </div>
            <p class="c_para mb-0 fw-bold">{{ $totalStudents ?? 0 }}</p>
            <small class="opacity-75">Total enrolled</small>
        </div>

        <!-- Total Teachers -->
        <div class="teachers c_card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0 fw-semibold">Teachers</h3>
                <i class="fas fa-chalkboard-teacher fa-2x opacity-75"></i>
            </div>
            <p class="c_para mb-0 fw-bold">{{ $totalTeachers ?? 0 }}</p>
            <small class="opacity-75">Active faculty</small>
        </div>

        <!-- Total Income -->
        <div class="income c_card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0 fw-semibold">Income</h3>
                <i class="fas fa-chart-line fa-2x opacity-75"></i>
            </div>
            <p class="c_para mb-0 fw-bold">₹{{ number_format($totalIncome ?? 0) }}</p>
            <small class="opacity-75">Total received</small>
        </div>

        <!-- Total Expenses -->
        <div class="expenses c_card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0 fw-semibold">Expenses</h3>
                <i class="fas fa-receipt fa-2x opacity-75"></i>
            </div>
            <p class="c_para mb-0 fw-bold">₹{{ number_format($totalExpenses ?? 0) }}</p>
            <small class="opacity-75">Total spent (salary + misc exp)</small>
        </div>

        <!-- Total Dues -->
        <div class="dues c_card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0 fw-semibold">Dues</h3>
                <i class="fas fa-exclamation-circle fa-2x opacity-75"></i>
            </div>
            <p class="c_para mb-0 fw-bold">₹{{ number_format($totalDues ?? 0) }}</p>
            <small class="opacity-75">Outstanding</small>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="add-fees-section">
                <div class="add-fees-header">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-3">
                        <a href="{{ route('students.create') }}" class="btn btn-success w-100 py-3">
                            <i class="fas fa-user-plus mb-2 d-block fa-lg"></i>
                            Add Student
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('teachers.create') }}" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-chalkboard-teacher mb-2 d-block fa-lg"></i>
                            Add Teacher
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('student-fees.create') }}" class="btn btn-info w-100 py-3 text-white">
                            <i class="fas fa-file-invoice-dollar mb-2 d-block fa-lg"></i>
                            Collect Fee
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('misc-expenses.create') }}" class="btn btn-warning w-100 py-3 text-white">
                            <i class="fas fa-coins mb-2 d-block fa-lg"></i>
                            Add Expense
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
