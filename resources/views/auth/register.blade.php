<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/Logo-Xavier.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
            border-radius: 12px;
        }

        .register-logo img {
            width: 80px;
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="card register-card shadow-lg">
    <div class="card-body p-4">

        <!-- LOGO -->
        <div class="text-center register-logo mb-3">
            <img src="{{ asset('img/Logo-Xavier.png') }}" alt="Logo">
            <h4 class="mt-2 fw-bold">Create Account</h4>
            <small class="text-muted">Register a new membership</small>
        </div>

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="/register">
            @csrf

            <!-- NAME -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>

            <!-- EMAIL -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <!-- ROLE -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-people"></i></span>
                <select name="role" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    <option value="nurse">Nurse</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <span class="input-group-text password-toggle" onclick="togglePassword('password','eye1')">
                    <i class="bi bi-eye" id="eye1"></i>
                </span>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation','eye2')">
                    <i class="bi bi-eye" id="eye2"></i>
                </span>
            </div>

            <!-- BUTTON -->
            <button class="btn btn-success w-100 fw-bold">
                Create Account
            </button>
        </form>

        <!-- BACK -->
        <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none">
                Already have an account? Login
            </a>
        </div>

    </div>
</div>

<!-- JS -->
<script>
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === "password") {
            field.type = "text";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            field.type = "password";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>

</body>
</html>
