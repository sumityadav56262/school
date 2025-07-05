<!DOCTYPE html>
<html>

<head>
    <title>School Management System</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_pagination.css') }}">

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
    <nav class="text-center text-white c_nav d-flex justify-content-around align-items-center">
        <h1>Sapience Academy</h1>

        <div class="dropdown">
            <button class="btn d-flex align-items-center text-success" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-2x me-2"></i> {{-- Font Awesome user icon --}}
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                <li>
                    <a class="dropdown-item" href="{{ route('password.change') }}">Change Password</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="menu">
            <a class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a class="menu-item {{ request()->routeIs('students.*') ? 'active' : '' }}"
                href="{{ route('students.index') }}">
                <i class="fas fa-user-graduate"></i>
                <span>Students</span>
            </a>
            <a class="menu-item {{ request()->routeIs('student-fees.*') ? 'active' : '' }}"
                href="{{ route('student-fees.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Student Fees</span>
            </a>
            <a class="menu-item {{ request()->routeIs('stud-classes.*') ? 'active' : '' }}"
                href="{{ route('stud-classes.index') }}">
                <i class="fas fa-school"></i>
                <span>Classes</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teachers.*') ? 'active' : '' }}"
                href="{{ route('teachers.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teachers</span>
            </a>
            <a class="menu-item {{ request()->routeIs('teacher-expenses.*') ? 'active' : '' }}"
                href="{{ route('teacher-expenses.index') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Teacher Exps</span>
            </a>
            <a class="menu-item {{ request()->routeIs('misc-expenses.*') ? 'active' : '' }}"
                href="{{ route('misc-expenses.index') }}">
                <i class="fas fa-coins"></i>
                <span>Misc Exps</span>
            </a>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3 z-3" role="alert" id="autoDismissAlert">
            {{ session('status') }}
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

    <script type="text/javascript">
        $(function() {
            // -------------------------------
            // Initialize all DataTables
            // -------------------------------
            const dataTablesClasses = [
                '.misc_expenses_datatable',
                '.student_datatable',
                '.teacher_datatable',
                '.teacher_expense_datatable',
                '.student_fee_datatable',
                '.student_classes_datatable'
            ];

            dataTablesClasses.forEach(selector => {
                $(selector).DataTable();
            });

            // -------------------------------
            // Set values into form fields
            // -------------------------------
            function setStudentValues(values = {}) {
                if (values.emis_no !== undefined) {
                    $('#emis_no').val(values.emis_no);
                }
                if (values.class_name !== undefined) {
                    $('#class_name').val(values.class_name);
                }
                if (values.roll_no !== undefined) {
                    $('#roll_no').val(values.roll_no);
                }
                if (values.student_name !== undefined) {
                    $('#student_name').val(values.student_name);
                }
                if (values.recurring_dues !== undefined) {
                    $('#recurring_dues').val(values.recurring_dues);
                }
            }

            // -------------------------------
            // Search student by EMIS no
            // -------------------------------
            $('#searchStudByEMISBtn').on('click', function() {
                const emis_no = $('#emis_no').val();

                if (emis_no) {
                    $.ajax({
                        url: "{{ route('student.get_student') }}",
                        type: 'GET',
                        data: {
                            emis_no
                        },
                        success: function(response) {
                            if (response.student) {
                                setStudentValues({
                                    class_name: response.student.class_name,
                                    roll_no: response.student.roll_no,
                                    student_name: response.student.stud_name,
                                    recurring_dues: response.recurring_dues
                                });
                            } else {
                                setStudentValues({
                                    class_name: '',
                                    roll_no: '',
                                    student_name: '',
                                    recurring_dues: ''
                                });
                                alert("No student found!");
                            }
                            calculateAmounts();
                        },
                        error: function() {
                            alert("Error fetching data!");
                        }
                    });
                } else {
                    setStudentValues({
                        class_name: '',
                        roll_no: '',
                        student_name: '',
                        recurring_dues: ''
                    });
                    calculateAmounts();
                    alert("Write valid emis no..!");
                }
            });

            // -------------------------------
            // Search student by Class and Roll No
            // -------------------------------
            $('#searchStudByClassRollBtn').on('click', function() {
                const class_name = $('#class_name').val();
                const roll_no = $('#roll_no').val();

                if (class_name && roll_no) {
                    $.ajax({
                        url: "{{ route('student.get_student_by_rollno_class') }}",
                        type: 'GET',
                        data: {
                            class_name,
                            roll_no
                        },
                        success: function(response) {
                            if (response.student) {
                                setStudentValues({
                                    emis_no: response.student.emis_no,
                                    student_name: response.student.stud_name,
                                    recurring_dues: response.recurring_dues
                                });
                            } else {
                                setStudentValues({
                                    emis_no: '',
                                    student_name: '',
                                    recurring_dues: ''
                                });
                                alert("No student found!");
                            }
                            calculateAmounts();
                        },
                        error: function() {
                            alert("Error fetching data!");
                        }
                    });
                } else {
                    setStudentValues({
                        emis_no: '',
                        student_name: '',
                        recurring_dues: ''
                    });
                    calculateAmounts();
                    alert("Select valid class name and roll no!");
                }
            });

            // -------------------------------
            // Calculate total amounts
            // -------------------------------
            function calculateAmounts() {
                let total = 0;

                // Sum all individual fees
                $('.fee-field').each(function() {
                    const val = parseInt($(this).val()) || 0;
                    total += val;
                });

                // Add recurring dues if checkbox checked
                if ($('#addRecuringDues').is(':checked')) {
                    const recurDues = parseInt($('#recurring_dues').val()) || 0;
                    total += recurDues;
                }

                $('#total_amt').val(total);

                const discount = parseInt($('#discount_amt').val()) || 0;
                const payment = parseInt($('#payment_amt').val()) || 0;

                let grandTotal = total - discount;
                if (grandTotal < 0) grandTotal = 0;

                let dues = grandTotal - payment;
                if (dues < 0) dues = 0;

                $('#dues_amt').val(dues);
            }

            // Attach change events
            $('.fee-field, #discount_amt, #payment_amt, #addRecuringDues').on('keyup change', calculateAmounts);

            // Initial calculation
            calculateAmounts();
        });
        
        // Auto-hide alert after 3 seconds
        setTimeout(function () {
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
