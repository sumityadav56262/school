<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_pagination.css') }}">

    <!-- Font Awesome CDN for icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />

    {{-- Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Datatable CSS--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
        
</head>
<body>
    <nav class="navbar">
        <h1>SCHOOL NAME</h1>
    </nav>
    <div class="container">
        <div class="menu">
            <a class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt" style="margin-right: 8px;"></i>
                <span>Dashboard</span>
            </a>
            <a class="menu-item {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <i class="fas fa-user-graduate" style="margin-right: 8px;"></i>
                <span>Students</span>
            </a>
            <a class="menu-item {{ request()->routeIs('student-fees.*') ? 'active' : '' }}" href="{{ route('student-fees.index') }}">
                <i class="fas fa-file-invoice-dollar" style="margin-right: 8px;"></i>
                <span>Student Fees</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teachers.*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">
                <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>
                <span>Teachers</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teacher-expenses.*') ? 'active' : '' }}" href="{{ route('teacher-expenses.index') }}">
                <i class="fas fa-money-bill-wave" style="margin-right: 8px;"></i>
                <span>Teach Expenses</span>
            </a>
            <a class="menu-item {{ request()->routeIs('misc-expenses.*') ? 'active' : '' }}" href="{{ route('misc-expenses.index') }}">
                <i class="fas fa-coins" style="margin-right: 8px;"></i>
                <span>Misc Expenses</span>
            </a>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>


    {{-- Jquery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Boostrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Datatable Js --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script type="text/javascript">

        //Initializing datatable        
        // misc_expenses_datatable
        $(document).ready(function (){
            $('.misc_expenses_datatable').DataTable();
        });

        // student_datatable
        $(document).ready(function (){
            $('.student_datatable').DataTable();
        });
        
        // teacher_datatable
        $(document).ready(function (){
            $('.teacher_datatable').DataTable();
        });
        
    </script>
</body>
</html>
