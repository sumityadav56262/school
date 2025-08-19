<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapience Academy - Modern School Management</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Datatable CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" />

    {{-- Nepali datepicker CSS --}}
    <link href="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/css/nepali.datepicker.v5.0.4.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('component.nav')

    <div class="container">
        <div class="menu {{ session('isHidden') ? 'hide' : '' }}">
            <div class="w-100 text-center mb-4 p-4 pt-0 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-light fw-bold">Navigation</h5>
                <i class="fa-solid fa-rectangle-list" id='sidebarIcon'></i>
            </div>


            <a class="menu-item {{ request()->routeIs('dashboard') ? 'bg-success' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-divider my-3"></div>

            <a class="menu-item {{ request()->routeIs('students.*') ? 'bg-success' : '' }}"
                href="{{ route('students.index') }}">
                <i class="fas fa-user-graduate"></i>
                <span>Students</span>
            </a>
            <a class="menu-item {{ request()->routeIs('student-fees.*') ? 'bg-success' : '' }}"
                href="{{ route('student-fees.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Collect Fee</span>
            </a>

            <div class="menu-divider my-3"></div>

            <a class="menu-item {{ request()->routeIs('teachers.*') ? 'bg-success' : '' }}"
                href="{{ route('teachers.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teachers</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teacher-expenses.*') ? 'bg-success' : '' }}"
                href="{{ route('teacher-expenses.index') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Teacher Expenses</span>
            </a>

            <div class="menu-divider my-3"></div>

            <a class="menu-item {{ request()->routeIs('misc-expenses.*') ? 'bg-success' : '' }}"
                href="{{ route('misc-expenses.index') }}">
                <i class="fas fa-coins"></i>
                <span>Misc Expenses</span>
            </a>
        </div>
        <div class="main-content">
            {{-- Content will be injected here --}}
            @yield('content')
        </div>
    </div>
    {{-- Success message --}}
    @if (session('success') || session('status'))
        <div class="alert bg-success text-white alert-dismissible fade show position-fixed bottom-0 end-0 m-3 z-3 autoDismissAlert"
            role="alert">
            {{ session('success') ?? session('status') }}
        </div>
    @endif
    @if (session('archive'))
        <div class="alert bg-danger text-white alert-dismissible fade show position-fixed bottom-0 end-0 m-3 z-3 autoDismissAlert"
            role="alert">
            {{ session('archive') }}
        </div>
    @endif

    {{-- Jquery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Boostrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Nepali datepicker -->
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.4.min.js"
        type="text/javascript"></script>

    {{-- Data-Table --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>

    {{-- Custom JS --}}
    <script>
        const getStudentUrl = "{{ route('student.get_student') }}";
        const getStudentByRollNoClassUrl = "{{ route('student.get_student_by_rollno_class') }}";
        const getTeacherByIdCardNoUrl = "{{ route('teacher.get_teacher_by_id_card_no') }}";
        const getTeacherByNameUrl = "{{ route('teacher.get_teacher_by_name') }}";
    </script>
    <script src="{{ asset('js/student_fee.js') }}"></script>
    <script src="{{ asset('js/teacher_expense.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script type="text/javascript">
        // Nepali date picker initialization
        const input = document.getElementById("nepali-datepicker");
        if (input && input.NepaliDatePicker) {
            input.NepaliDatePicker();
        }

        const paid_date = document.getElementById("paid_date");
        if (paid_date && paid_date.NepaliDatePicker) {
            paid_date.NepaliDatePicker();
        }

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
                    ],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "Showing 0 to 0 of 0 entries",
                        infoFiltered: "(filtered from _MAX_ total entries)",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        },
                        emptyTable: "No data available in table",
                        zeroRecords: "No matching records found"
                    },
                    pageLength: 10,
                    lengthMenu: [
                        [5, 10, 25, 50],
                        [5, 10, 25, 50]
                    ],
                    responsive: true,
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false
                    }]
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
