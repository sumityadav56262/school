// -------------------------------
// Teacher Expense
// -------------------------------

// Wait for DOM to be fully loaded before attaching event listeners
// This ensures all elements are available in the DOM
// Using 'DOMContentLoaded' to ensure the script runs after the HTML is fully parsed
document.addEventListener("DOMContentLoaded", function () {
    // -------------------------------
    // Calculate dues amounts
    // -------------------------------
    function calculateDuesAmounts() {
        const salaryField = document.querySelector(".salary_amt");
        const paidField = document.querySelector(".paid_amt");
        const dueField = document.getElementById("due_amt");

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
    const salaryFields = document.querySelectorAll(".salary_amt, .paid_amt");
    if (salaryFields.length > 0) {
        salaryFields.forEach((field) => {
            field.addEventListener("keyup", calculateDuesAmounts);
            field.addEventListener("change", calculateDuesAmounts);
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
        const url =
            typeof getTeacherByIdCardNoUrl !== "undefined"
                ? getTeacherByIdCardNoUrl +
                  "?id_card_no=" +
                  encodeURIComponent(id_card_no)
                : "";

        if (!url) {
            console.error("Teacher search URL is not defined!");
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
            const teacherNameField = document.getElementById("teacher_name");
            if (teacherNameField) {
                if (data.teacher_name) {
                    teacherNameField.value = data.teacher_name;
                } else {
                    teacherNameField.value = "";
                    console.log("No teacher found!");
                }
            }
        } catch (error) {
            console.log("Error fetching data!", error);
        }
    }

    // Attach event listener to ID card field
    const idCardField = document.getElementById("id_card_no");
    if (idCardField) {
        idCardField.addEventListener("change", function () {
            const id_card_no = this.value;

            if (id_card_no) {
                searchTeacherByIdCard(id_card_no);
            } else {
                const teacherNameField =
                    document.getElementById("teacher_name");
                if (teacherNameField) {
                    teacherNameField.value = "";
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
        const url =
            typeof getTeacherByNameUrl !== "undefined"
                ? getTeacherByNameUrl +
                  "?teacher_name=" +
                  encodeURIComponent(teacher_name)
                : "";
        if (!url) {
            console.error("Teacher search URL is not defined!");
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

            const idCardField = document.getElementById("id_card_no");
            if (idCardField) {
                if (data.id_card_no) {
                    idCardField.value = data.id_card_no;
                } else {
                    idCardField.value = "";
                    console.log("No teacher found!");
                }
            }
        } catch (error) {
            console.log("Error fetching data!", error);
        }
    }

    const teacherNameField = document.getElementById("teacher_name");
    if (teacherNameField) {
        teacherNameField.addEventListener("change", function () {
            const teacher_name = this.value;

            if (teacher_name) {
                searchTeacherByName(teacher_name);
            } else {
                const idCardField = document.getElementById("id_card_no");
                if (idCardField) {
                    idCardField.value = "";
                }
                console.log("Write valid Teacher Name..!");
            }
        });
    } else {
        console.log("Element #teacher_name not found in DOM.");
    }
});
