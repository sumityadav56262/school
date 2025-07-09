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
    @include('component.nav')

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
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3 z-3"
            role="alert" id="autoDismissAlert">
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
                $(selector).DataTable();
            });
        });


        // -------------------------------
        // Student Fee
        // -------------------------------
        $(function() {

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

        // -------------------------------
        // Teacher Expense
        // -------------------------------
        $(function() {
            // -------------------------------
            // Calculate dues amounts
            // -------------------------------
            function calculateDuesAmounts() {
                let due_amt = 0;
                const salary_amt = parseInt($('.salary_amt').val()) || 0;
                const paid_amt = parseInt($('.paid_amt').val()) || 0;
                if (salary_amt < 0) {
                    alert("Salary amount cannot be negative!");
                    $('.salary_amt').val(0);
                    return;
                }
                due_amt = salary_amt - paid_amt;
                if (due_amt < 0) due_amt = 0;

                $('#due_amt').val(due_amt);
            }

            // Attach change events
            $('.salary_amt, .paid_amt').on('keyup change', calculateDuesAmounts);

            // Initial dues calculation
            calculateDuesAmounts();

            // -------------------------------
            // Search Teacher By Id Card No
            // -------------------------------
            $('#id_card_no').on('change', function() {
                const id_card_no = $(this).val();
                if (id_card_no) {
                    $.ajax({
                        url: "{{ route('teacher.get_teacher_by_id_card_no') }}",
                        type: 'GET',
                        data: {
                            id_card_no
                        },
                        success: function(response) {
                            if (response.teacher_name) {
                                $('#teacher_name').val(response.teacher_name);
                            } else {
                                $('#teacher_name').val('');
                                alert("No teacher found!");
                                console.log('No teacher found!');
                            }
                        },
                        error: function() {
                            console.log("Error fetching data!");
                        }
                    });
                } else {
                    $('#teacher_name').val('');
                    console.log("Write valid ID card no..!");
                }
            });


            // -------------------------------
            // Search Teacher By Name
            // -------------------------------
            $('#teacher_name').on('change', function() {
                const teacher_name = $(this).val();

                if (teacher_name) {
                    $.ajax({
                        url: "{{ route('teacher.get_teacher_by_name') }}",
                        type: 'GET',
                        data: {
                            teacher_name
                        },
                        success: function(response) {
                            if (response) {
                                $('#id_card_no').val(response.id_card_no);
                            } else {
                                $('#id_card_no').val('');
                                console.log('Invalid Teacher Name!');
                            }
                        },
                        error: function() {
                            console.log("Error fetching data!");
                        }
                    });
                } else {
                    $('#id_card_no').val('');
                    console.log("Write valid Teacher Name..!");
                }
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
