// -------------------------------
// STUDENT FEE JS
// -------------------------------
// Set values into form fields
// -------------------------------
function setStudentValues(values = {}) {
    if (values.emis_no !== undefined) {
        document.getElementById("emis_no").value = values.emis_no;
    }
    if (values.class_name !== undefined) {
        document.getElementById("class_name").value = values.class_name;
    }
    if (values.roll_no !== undefined) {
        document.getElementById("roll_no").value = values.roll_no;
    }
    if (values.student_name !== undefined) {
        document.getElementById("student_name").value = values.student_name;
    }
    if (values.recurring_dues !== undefined) {
        document.getElementById("recurring_dues").value = values.recurring_dues;
    }
    updateRecurringDuesCheckbox();
}

function updateRecurringDuesCheckbox() {
    const recurringDues = parseInt($("#recurring_dues").val()) || 0;
    const $checkbox = $("#addRecuringDues");
    $checkbox.attr("disabled", recurringDues <= 0);
    if (recurringDues <= 0 && $checkbox.is(":checked")) {
        $checkbox.prop("checked", false);
    }
}

// -------------------------------
// Calculate total amounts
// -------------------------------
function calculateAmounts() {
    let total = 0;

    // Sum all individual fees
    $(".fee-field").each(function () {
        const val = parseInt($(this).val()) || 0;
        total += val;
    });

    // Add recurring dues if checkbox checked
    if ($("#addRecuringDues").is(":checked")) {
        const recurDues = parseInt($("#recurring_dues").val()) || 0;
        total += recurDues;
    }

    $("#total_amt").val(total);

    const discount = parseInt($("#discount_amt").val()) || 0;
    const payment = parseInt($("#payment_amt").val()) || 0;

    let grandTotal = total - discount;
    if (grandTotal < 0) grandTotal = 0;

    let dues = grandTotal - payment;
    if (dues < 0) dues = 0;

    $("#dues_amt").val(dues);
}

$(function () {
    // -------------------------------
    // Attach change events
    // -------------------------------
    $(".fee-field, #discount_amt, #addRecuringDues").on(
        "keyup change",
        calculateAmounts
    );

    // Ensure payment amount is not greater than total amount
    $("#payment_amt").on("keyup change", () => {
        const paymentAmt = parseInt($("#payment_amt").val()) || 0;
        const totalAmt = parseInt($("#total_amt").val()) || 0;

        if (paymentAmt > totalAmt) {
            alert("Payment amount cannot be greater than total amount!");
            $("#payment_amt").val(totalAmt);
            // Reset discount if payment exceeds total
            $("#discount_amt").val(0);
        }

        // Enable discount field only if payment is less than total
        $("#discount_amt").attr("disabled", paymentAmt >= totalAmt);

        calculateAmounts();
    });

    // Initial calculation
    calculateAmounts();
});

// -------------------------------
// Student Fee
// -------------------------------

// Wait for DOM to be fully loaded before attaching event listeners
// This ensures all elements are available in the DOM
// Using 'DOMContentLoaded' to ensure the script runs after the HTML is fully parsed
document.addEventListener("DOMContentLoaded", function () {
    // -------------------------------
    // Search student by EMIS no
    // -------------------------------
    async function searchStudentByEMIS(emis_no) {
        // Use the global variable set in Blade
        const url =
            typeof getStudentUrl !== "undefined"
                ? getStudentUrl + "?emis_no=" + encodeURIComponent(emis_no)
                : "";
        if (!url) {
            console.error("Student search URL is not defined!");
            return;
        }
        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    Accept: "application/json",
                },
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
                    recurring_dues: data.recurring_dues,
                });
            } else {
                setStudentValues({
                    class_name: "",
                    roll_no: "",
                    student_name: "",
                    recurring_dues: "",
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
    const searchStudByEMISBtn = document.getElementById("searchStudByEMISBtn");
    if (!searchStudByEMISBtn) {
        console.error("Element searchStudByEMISBtn not found in DOM.");
        return;
    } else {
        searchStudByEMISBtn.addEventListener("click", () => {
            const emis_no = document.getElementById("emis_no").value;
            if (emis_no) {
                searchStudentByEMIS(emis_no);
            } else {
                setStudentValues({
                    class_name: "",
                    roll_no: "",
                    student_name: "",
                    recurring_dues: "",
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
        const url =
            typeof getStudentByRollNoClassUrl !== undefined
                ? getStudentByRollNoClassUrl +
                  `?class_name=${encodeURIComponent(
                      class_name
                  )}&roll_no=${encodeURIComponent(roll_no)}`
                : "";
        if (!url) {
            console.error("Student search URL is not defined!");
            return;
        }
        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    Accept: "application/json",
                },
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            if (data.student) {
                setStudentValues({
                    emis_no: data.student.emis_no,
                    student_name: data.student.stud_name,
                    recurring_dues: data.recurring_dues,
                });
            } else {
                setStudentValues({
                    emis_no: "",
                    student_name: "",
                    recurring_dues: "",
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
    const searchStudByClassRollBtn = document.getElementById(
        "searchStudByClassRollBtn"
    );
    if (!searchStudByClassRollBtn) {
        console.error("Element #searchStudByClassRollBtn not found in DOM.");
        return;
    } else {
        searchStudByClassRollBtn.addEventListener("click", () => {
            const class_name = document.getElementById("class_name").value;
            const roll_no = document.getElementById("roll_no").value;

            if (class_name && roll_no) {
                searchStudentByClassAndRoll(class_name, roll_no);
            } else {
                setStudentValues({
                    emis_no: "",
                    student_name: "",
                    recurring_dues: "",
                });
                calculateAmounts();
                alert("Select valid class name and roll no!");
            }
        });
    }
});
