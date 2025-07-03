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
    <nav class="text-center text-white c_nav">
        <h1>Sapience Academy</h1>
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


    {{-- Jquery JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Nepali datepicker JS --}}
    <script src="https://cdn.rohan.info.np/NepaliDatePicker/Nepali-datepicker.min.js"></script>

    {{-- Boostrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Datatable Js --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script type="text/javascript">
        //Initializing datatable        
        // misc_expenses_datatable
        $(document).ready(function() {
            $('.misc_expenses_datatable').DataTable();
        });

        // student_datatable
        $(document).ready(function() {
            $('.student_datatable').DataTable();
        });

        // teacher_datatable
        $(document).ready(function() {
            $('.teacher_datatable').DataTable();
        });

        // teacher_expense_datatable
        $(document).ready(function() {
            $('.teacher_expense_datatable').DataTable();
        });

        // student_fee_datatable
        $(document).ready(function() {
            $('.student_fee_datatable').DataTable();
        });
        // student_classes_datatable
        $(document).ready(function() {
            $('.student_classes_datatable').DataTable();
        });

        // Load Studetn detail based on emis no
        $(document).ready(function() {
            $('#searchStudBtn').on('click', function() {
                var emis_no = $('#emis_no').val();

                if (emis_no) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/get-student',
                        type: 'GET',
                        data: {
                            emis_no: emis_no
                        },
                        success: function(response) {
                            if (response.student) {
                                $('#class_name').val(response.student.class_name || '');
                                $('#roll_no').val(response.student.roll_no || '');
                                $('#student_name').val(response.student.stud_name || '');
                            } else {
                                $('#class_name').val('');
                                $('#roll_no').val('');
                                $('#student_name').val('');

                                alert("No student found!");
                            }
                        },
                        error: function() {
                            alert("Error fetching data!");
                        }
                    });
                } else {
                    $('#class_name').val('');
                    $('#roll_no').val('');
                    $('#student_name').val('');
                }
            });
        });

        // Calculate total amounts
        $(document).ready(function() {
            function calculateAmounts() {
                var total = 0;

                // Sum all fees
                $('.fee-field').each(function() {
                    var val = parseInt($(this).val()) || 0;
                    total += val;
                });

                // Update Total field
                $('#total_amt').val(total);

                // Get discount and payment values
                var discount = parseInt($('#discount_amt').val()) || 0;
                var payment = parseInt($('#payment_amt').val()) || 0;

                // Calculate grand total after discount
                var grandTotal = total - discount;
                if (grandTotal < 0) grandTotal = 0;

                // Calculate dues
                var dues = grandTotal - payment;
                if (dues < 0) dues = 0;

                // Update Dues field
                $('#dues_amt').val(dues);
            }

            // Recalculate when any relevant field changes
            $('.fee-field, #discount_amt, #payment_amt').on('keyup change', function() {
                calculateAmounts();
            });

            // Initial calculation on page load
            calculateAmounts();
        });
    </script>
</body>

</html>
