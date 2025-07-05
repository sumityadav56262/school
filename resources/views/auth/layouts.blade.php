<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .success-focus:focus {
        border-color: var(--bs-success);
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        outline: none;
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
</body>
</html>
