<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Font Awesome CDN for icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
</head>
<body>
    <div class="navbar">School Fee & Expense Management</div>
    <div class="container">
        <div class="menu">
            <a class="menu-item" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt" style="margin-right: 8px;"></i>
                <span>Dashboard</span>
            </a>

            <a class="menu-item" href="{{ route('students.index') }}">
                <i class="fas fa-user-graduate" style="margin-right: 8px;"></i>
                <span>Students</span>
            </a>
            <a class="menu-item" href="{{ route('student-fees.index') }}">
                <i class="fas fa-file-invoice-dollar" style="margin-right: 8px;"></i>
                <span>Student Fees</span>
            </a>
            <a class="menu-item" href="{{ route('teachers.index') }}">
                <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>
                <span>Teachers</span>
            </a>
            <a class="menu-item" href="{{ route('teacher-expenses.index') }}">
                <i class="fas fa-money-bill-wave" style="margin-right: 8px;"></i>
                <span>Teacher Expenses</span>
            </a>
            <a class="menu-item" href="{{ route('misc-expenses.index') }}">
                <i class="fas fa-coins" style="margin-right: 8px;"></i>
                <span>Misc Expenses</span>
            </a>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
