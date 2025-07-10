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
        // STUDENT FEE
        // -------------------------------

        // -------------------------------
        // Set values into form fields
        // -------------------------------
        function setStudentValues(values = {}) {
            if (values.emis_no !== undefined) {
                document.getElementById('emis_no').value = values.emis_no;
            }
            if (values.class_name !== undefined) {
                document.getElementById('class_name').value = values.class_name;
            }
            if (values.roll_no !== undefined) {
                document.getElementById('roll_no').value = values.roll_no;
            }
            if (values.student_name !== undefined) {
                document.getElementById('student_name').value = values.student_name;
            }
            if (values.recurring_dues !== undefined) {
                document.getElementById('recurring_dues').value = values.recurring_dues;
            }
        }

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

        $(function() {
            // -------------------------------
            // Attach change events
            // -------------------------------
            $('.fee-field, #discount_amt, #payment_amt, #addRecuringDues').on('keyup change', calculateAmounts);

            // Initial calculation
            calculateAmounts();
        });


        // -------------------------------
        // Student Fee
        // -------------------------------

        // Wait for DOM to be fully loaded before attaching event listeners
        // This ensures all elements are available in the DOM
        // Using 'DOMContentLoaded' to ensure the script runs after the HTML is fully parsed
        document.addEventListener('DOMContentLoaded', function() {

            // -------------------------------
            // Search student by EMIS no
            // -------------------------------        
            async function searchStudentByEMIS(emis_no) {
                const url = "{{ route('student.get_student') }}" + '?emis_no=' + encodeURIComponent(emis_no);
                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const data = await response.json();

                    if (data.student) {
                        setStudentValues({
                            class_name: data.student.class_name,
                            roll_no: data.student.roll_no,
                            student_name: data.student.stud_name,
                            recurring_dues: data.recurring_dues
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

                } catch (error) {
                    alert("Error fetching data!");
                    console.error(error);
                }
            }

            // Event listener: Search by EMIS
            // This will be triggered when the button is clicked                
            const searchStudByEMISBtn = document.getElementById('searchStudByEMISBtn');
            if (!searchStudByEMISBtn) {
                //console.error("Element searchStudByEMISBtn not found in DOM.");
                return;
            } else {
                searchStudByEMISBtn.addEventListener('click', () => {
                    const emis_no = document.getElementById('emis_no').value;

                    if (emis_no) {
                        searchStudentByEMIS(emis_no);
                    } else {
                        setStudentValues({
                            class_name: '',
                            roll_no: '',
                            student_name: '',
                            recurring_dues: ''
                        });
                        calculateAmounts();
                        alert("Write valid EMIS no..!");
                    }
                });
            }

            // -------------------------------
            // Search student by Class and Roll No
            // -------------------------------
            async function searchStudentByClassAndRoll(class_name, roll_no) {
                const url = "{{ route('student.get_student_by_rollno_class') }}" +
                    `?class_name=${encodeURIComponent(class_name)}&roll_no=${encodeURIComponent(roll_no)}`;

                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const data = await response.json();

                    if (data.student) {
                        setStudentValues({
                            emis_no: data.student.emis_no,
                            student_name: data.student.stud_name,
                            recurring_dues: data.recurring_dues
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

                } catch (error) {
                    alert("Error fetching data!");
                    console.error(error);
                }
            }

            // ✅ DOM is ready, attach listener safely
            const searchStudByClassRollBtn = document.getElementById('searchStudByClassRollBtn');
            if (!searchStudByClassRollBtn) {
                console.error("Element #searchStudByClassRollBtn not found in DOM.");
                return;
            } else {
                searchStudByClassRollBtn.addEventListener('click', () => {
                    const class_name = document.getElementById('class_name').value;
                    const roll_no = document.getElementById('roll_no').value;

                    if (class_name && roll_no) {
                        searchStudentByClassAndRoll(class_name, roll_no);
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
            }
        });


        // -------------------------------
        // Teacher Expense
        // -------------------------------

        // Wait for DOM to be fully loaded before attaching event listeners
        // This ensures all elements are available in the DOM
        // Using 'DOMContentLoaded' to ensure the script runs after the HTML is fully parsed
        document.addEventListener('DOMContentLoaded', function() {

            // -------------------------------
            // Calculate dues amounts
            // -------------------------------
            function calculateDuesAmounts() {
                const salaryField = document.querySelector('.salary_amt');
                const paidField = document.querySelector('.paid_amt');
                const dueField = document.getElementById('due_amt');

                if (!salaryField || !paidField || !dueField) {
                    console.log("Some fields for calculation are missing in DOM.");
                    return;
                }

                const salary_amt = parseInt(salaryField.value) || 0;
                const paid_amt = parseInt(paidField.value) || 0;

                if (salary_amt < 0) {
                    alert("Salary amount cannot be negative!");
                    salaryField.value = 0;
                    return;
                }

                let due_amt = salary_amt - paid_amt;
                if (due_amt < 0) due_amt = 0;

                dueField.value = due_amt;
            }

            // Attach change events for salary and paid amounts
            const salaryFields = document.querySelectorAll('.salary_amt, .paid_amt');
            if (salaryFields.length > 0) {
                salaryFields.forEach(field => {
                    field.addEventListener('keyup', calculateDuesAmounts);
                    field.addEventListener('change', calculateDuesAmounts);
                });
                // Initial calculation
                calculateDuesAmounts();
            } else {
                console.log("No salary or paid amount fields found in DOM.");
            }

            // -------------------------------
            // Search Teacher By Id Card No
            // -------------------------------
            async function searchTeacherByIdCard(id_card_no) {
                const url = "{{ route('teacher.get_teacher_by_id_card_no') }}" +
                    '?id_card_no=' + encodeURIComponent(id_card_no);

                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const data = await response.json();

                    const teacherNameField = document.getElementById('teacher_name');
                    if (teacherNameField) {
                        if (data.teacher) {
                            teacherNameField.value = data.teacher.name;
                        } else {
                            teacherNameField.value = '';
                            console.log("No teacher found!");
                        }
                    }
                } catch (error) {
                    console.log("Error fetching data!", error);
                }
            }

            // Attach event listener to ID card field
            const idCardField = document.getElementById('id_card_no');
            if (idCardField) {
                idCardField.addEventListener('change', function() {
                    const id_card_no = this.value;

                    if (id_card_no) {
                        searchTeacherByIdCard(id_card_no);
                    } else {
                        const teacherNameField = document.getElementById('teacher_name');
                        if (teacherNameField) {
                            teacherNameField.value = '';
                        }
                        console.log("Write valid ID card no..!");
                    }
                });
            } else {
                console.log("Element #id_card_no not found in DOM.");
            }

            // -------------------------------
            // Search Teacher By Name
            // -------------------------------
            async function searchTeacherByName(teacher_name) {
                const url = "{{ route('teacher.get_teacher_by_name') }}" +
                    '?teacher_name=' + encodeURIComponent(teacher_name);

                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const data = await response.json();

                    const idCardField = document.getElementById('id_card_no');
                    if (idCardField) {
                        if (data.teacher) {
                            idCardField.value = data.teacher.id_card_no;
                        } else {
                            idCardField.value = '';
                            console.log("No teacher found!");
                        }
                    }
                } catch (error) {
                    console.log("Error fetching data!", error);
                }
            }

            const teacherNameField = document.getElementById('teacher_name');
            if (teacherNameField) {
                teacherNameField.addEventListener('change', function() {
                    const teacher_name = this.value;

                    if (teacher_name) {
                        searchTeacherByName(teacher_name);
                    } else {
                        const idCardField = document.getElementById('id_card_no');
                        if (idCardField) {
                            idCardField.value = '';
                        }
                        console.log("Write valid Teacher Name..!");
                    }
                });
            } else {
                console.log("Element #teacher_name not found in DOM.");
            }

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
