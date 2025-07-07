<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    .success-focus:focus {
        border-color: var(--bs-success);
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        outline: none;
    }
    #togglePasswordIcon,
    #toggleRegPasswordIcon,
    #toggleConfirmPasswordIcon {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
        color: #6c757d;
        z-index: 10;
    }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- Login Form -->
        <div class="w-25 card shadow rounded p-3 d-flex justify-content-center align-items-center flex-column">
            @yield('content')
        </div>
    </div>
    <script>
        function setupPasswordToggle(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input && icon) {
                icon.addEventListener('click', function () {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }
        }

        setupPasswordToggle('loginPassword', 'togglePasswordIcon');
        setupPasswordToggle('regPassword', 'toggleRegPasswordIcon');
        setupPasswordToggle('confirmPassword', 'toggleConfirmPasswordIcon');
    </script>
</body>
</html>
