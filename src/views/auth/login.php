<?php
session_start();
require_once __DIR__ . '/../../core/auth.php';
if (is_logged_in()) {
    header("Location: ../dashboard/main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Organize App</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/organize-app-ocean-blue/assets/css/style.css">
</head>
<body>

<small>Belum punya akun? <a href="register.php">Register</a></small>

<div class="auth-container">
    <h2 style="margin-bottom: 18px; text-align:center;">Organize App</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error-msg"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="success-msg"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <form method="POST" action="/organize-app-ocean-blue/src/controllers/AuthController.php">
        <input type="text" name="username" class="input-field" placeholder="Username" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <button class="btn-primary" type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
