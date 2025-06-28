@extends('layout')

@section('content')

<h2 style="text-align:center; margin-bottom: 30px; color: #333;">Dashboard Overview</h2>

<div style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;">

    <!-- Total Students -->
    <div style="flex: 1 1 200px; background: #28a745; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
        <h3>Total Students</h3>
        <p style="font-size: 48px; margin: 15px 0;">{{ $totalStudents ?? 0 }}</p>
    </div>

    <!-- Total Teachers -->
    <div style="flex: 1 1 200px; background: #007bff; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
        <h3>Total Teachers</h3>
        <p style="font-size: 48px; margin: 15px 0;">{{ $totalTeachers ?? 0 }}</p>
    </div>

    <!-- Total Income -->
    <div style="flex: 1 1 250px; background: #17a2b8; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
        <h3>Total Income (Rs.)</h3>
        <p style="font-size: 42px; margin: 15px 0;">{{ number_format($totalIncome ?? 0) }}</p>
    </div>

    <!-- Total Expenses -->
    <div style="flex: 1 1 250px; background: #dc3545; color: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
        <h3>Total Expenses (Rs.)</h3>
        <p style="font-size: 42px; margin: 15px 0;">{{ number_format($totalExpenses ?? 0) }}</p>
    </div>

    <!-- Total Dues -->
    <div style="flex: 1 1 250px; background: #ffc107; color: #856404; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
        <h3>Total Dues (Rs.)</h3>
        <p style="font-size: 42px; margin: 15px 0;">{{ number_format($totalDues ?? 0) }}</p>
    </div>

</div>

@endsection
