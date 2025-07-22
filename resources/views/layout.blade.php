<!DOCTYPE html>
<html>

<head>
    <title>School Management System</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    {{-- Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Datatable CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

    {{-- Nepali datepicker CSS --}}
    <link href="https://cdn.rohan.info.np/NepaliDatePicker/Nepali-datepicker.min.css" rel="stylesheet">
</head>

<body>
    @include('component.nav')

    <div class="container">
        <div class="menu">
            <a class="menu-item {{ request()->routeIs('dashboard') ? 'bg-success' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a class="menu-item {{ request()->routeIs('students.*') ? 'bg-success' : '' }}"
                href="{{ route('students.index') }}">
                <i class="fas fa-user-graduate"></i>
                <span>Students</span>
            </a>
            <a class="menu-item {{ request()->routeIs('student-fees.*') ? 'bg-success' : '' }}"
                href="{{ route('student-fees.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Student Fees</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teachers.*') ? 'bg-success' : '' }}"
                href="{{ route('teachers.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teachers</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teacher-expenses.*') ? 'bg-success' : '' }}"
                href="{{ route('teacher-expenses.index') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Teacher Exps</span>
            </a>
            <a class="menu-item {{ request()->routeIs('misc-expenses.*') ? 'bg-success' : '' }}"
                href="{{ route('misc-expenses.index') }}">
                <i class="fas fa-coins"></i>
                <span>Misc Exps</span>
            </a>
        </div>
        <div class="main-content m-0 p- 0">
            {{-- Content will be injected here --}}
            @yield('content')
        </div>
    </div>
    {{-- Success message --}}
    @if (session('success') || session('status'))
        <div class="alert bg-success text-white alert-dismissible fade show position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="autoDismissAlert">
            {{ session('success') ?? session('status') }}
        </div>
    @endif
    @if (session('archive'))
        <div class="alert bg-danger text-white alert-dismissible fade show position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="autoDismissAlert">
            {{ session('archive') }}
        </div>
    @endif


    {{-- Jquery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Nepali datepicker JS --}}
    <script src="https://cdn.rohan.info.np/NepaliDatePicker/Nepali-datepicker.min.js"></script>

    {{-- Boostrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Datatable Js --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    {{-- Custom JS --}}
    <script>
        const getStudentUrl = "{{ route('student.get_student') }}";
        const getStudentByRollNoClassUrl = "{{ route('student.get_student_by_rollno_class') }}";
        const getTeacherByIdCardNoUrl = "{{ route('teacher.get_teacher_by_id_card_no') }}";
        const getTeacherByNameUrl = "{{ route('teacher.get_teacher_by_name') }}";
    </script>
    <script src="{{ asset('js/student_fee.js') }}"></script>
    <script src="{{ asset('js/teacher_expense.js') }}"></script>

    <script type="text/javascript">
        // -------------------------------
        // Initialize all DataTables
        // -------------------------------
        $(function() {
            const dataTablesClasses = [
                '.misc_expenses_datatable',
                '.student_datatable',
                '.teacher_datatable',
                '.teacher_expense_datatable',
                '.student_fee_datatable',
                '.student_classes_datatable'
            ];

            dataTablesClasses.forEach(selector => {
                $(selector).DataTable({
                    order: [
                        [0, 'desc']
                    ]
                });
            });
        });

        // Auto-hide alert after 3 seconds
        setTimeout(function() {
            const alertBox = document.getElementById('autoDismissAlert');
            if (alertBox) {
                // Use Bootstrap's fade-out
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                setTimeout(() => alertBox.remove(), 500); // Remove from DOM after fade
            }
        }, 3000);
    </script>
</body>

</html>
