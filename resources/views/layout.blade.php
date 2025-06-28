<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="navbar">School Fee & Expense Management</div>
    <div class="container">
        <div class="menu">
            <a class="menu-item" href="{{ route('students.index') }}"><span>Students</span></a>
            <a class="menu-item" href="{{ route('student-fees.index') }}"><span>Student Fees</span></a>
            <a class="menu-item" href="{{ route('teachers.index') }}"><span>Teachers</span></a>
            <a class="menu-item" href="{{ route('teacher-expenses.index') }}"><span>Teacher Expenses</span></a>
            <a class="menu-item" href="{{ route('misc-expenses.index') }}"><span>Misc Expenses</span></a>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
