@extends('layout')

@section('content')
    <h2 style="text-align:center; margin-bottom: 30px; color: #333;">Overview</h2>

    <div class="c_div">
        <!-- Total Students -->
        <div class="students c_card">
            <h3>Students</h3>
            <p class="c_para">{{ $totalStudents ?? 0 }}</p>
        </div>

        <!-- Total Teachers -->
        <div class="teachers c_card">
            <h3>Teachers</h3>
            <p class="c_para">{{ $totalTeachers ?? 0 }}</p>
        </div>

        <!-- Total Income -->
        <div class="income c_card">
            <h3>Income (Rs.)</h3>
            <p class="c_para">{{ number_format($totalIncome ?? 0) }}</p>
        </div>

        <!-- Total Expenses -->
        <div class="expenses c_card">
            <h3>Expenses (Rs.)</h3>
            <p class="c_para">{{ number_format($totalExpenses ?? 0) }}</p>
        </div>

        <!-- Total Dues -->
        <div class="dues c_card">
            <h3>Dues (Rs.)</h3>
            <p class="c_para">{{ number_format($totalDues ?? 0) }}</p>
        </div>

    </div>
@endsection
