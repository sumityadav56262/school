<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title') - Sapience Academy</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f9fafb 0%, #e2e8f0 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        padding: 2.5rem;
        width: 100%;
        max-width: 450px;
        position: relative;
        overflow: hidden;
    }

    .auth-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        color: #1e293b;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .auth-header p {
        color: #64748b;
        font-size: 0.95rem;
        margin: 0;
    }

    .form-label {
        color: #374151;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #f9fafb;
    }

    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        background-color: white;
        outline: none;
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .password-input-group {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: #374151;
    }

    .btn-auth {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        border-radius: 8px;
        padding: 0.875rem 1.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        color: white;
        transition: all 0.2s ease;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-auth:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .auth-links {
        text-align: center;
        margin-top: 1.5rem;
    }

    .auth-links a {
        color: #10b981;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .auth-links a:hover {
        color: #059669;
        text-decoration: underline;
    }

    .alert {
        border-radius: 8px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .alert-danger {
        background-color: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
    }

    .alert-success {
        background-color: #f0fdf4;
        color: #16a34a;
        border-left: 4px solid #16a34a;
    }

    .text-danger {
        color: #dc2626 !important;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .brand-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: #1e293b;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .brand-logo i {
        margin-right: 0.5rem;
        color: #10b981;
    }

    @media (max-width: 576px) {
        .auth-container {
            margin: 1rem;
            padding: 2rem;
        }
    }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="brand-logo">
            <i class="fas fa-graduation-cap"></i>
            Sapience Academy
        </div>
        
        @yield('content')
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

        // Initialize password toggles
        document.addEventListener('DOMContentLoaded', function() {
            setupPasswordToggle('loginPassword', 'togglePasswordIcon');
            setupPasswordToggle('regPassword', 'toggleRegPasswordIcon');
            setupPasswordToggle('confirmPassword', 'toggleConfirmPasswordIcon');
        });
    </script>
</body>
</html>
