<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
      <!-- Favicon -->
      <link rel="shortcut icon" href="http://school-health-xjs.vercel.app/img/Logo-Xavier.png" type="image/x-icon">
    <link rel="icon" href="http://school-health-xjs.vercel.app/img/Logo-Xavier.png" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://school-health-xjs.vercel.app/img/Logo-Xavier.png">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
        }

        .login-logo img {
            width: 80px;
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="card login-card shadow-lg">
    <div class="card-body p-4">

        <!-- LOGO -->
        <div class="text-center login-logo mb-3">
            <img src="http://school-health-xjs.vercel.app/img/Logo-Xavier.png" alt="Logo">
            <h4 class="mt-2 fw-bold">Admin Panel</h4>
            <small class="text-muted">Sign in to start your session</small>
        </div>

        <!-- FORM -->
        <form method="POST" action="/login">
            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <!-- BUTTON -->
            <button class="btn btn-primary w-100 fw-bold">
                Sign In
            </button>
        </form>

        <!-- REGISTER -->
        <div class="text-center mt-3">
            <a href="/register" class="text-decoration-none">Create new account</a>
        </div>

    </div>
</div>

<!-- JS -->
<script>
    function togglePassword() {
        const password = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            password.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>

</body>
</html>
