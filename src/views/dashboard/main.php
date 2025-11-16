<?php
session_start();
require_once __DIR__ . '/../../core/auth.php';
if (!is_logged_in()) {
    header("Location: ../auth/login.php");
    exit;
}
$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Organize App</title>
    <link rel="stylesheet" href="/organize-app-ocean-blue/assets/css/style.css">
</head>
<body>

<div class="dashboard-wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Organize App</h2>
        <a class="active" href="main.php">Dashboard</a>
	<a href="../tugas/index.php">Tugas</a>
	<a href="../presensi/index.php">Presensi</a>
	<a href="../proker/index.php">Proker</a>
	<a href="/organize-app-ocean-blue/src/controllers/AuthController.php?logout=1" style="margin-top:auto;">Logout</a>
    </div>

    <!-- Content -->
    <div class="dashboard-content">
        <h2>Selamat datang, <b><?= htmlspecialchars($user["username"]) ?></b> 👋</h2>
        <p>Role: <b><?= htmlspecialchars($user["role"]) ?></b></p>

        <div class="card">
            <h3>Tambah Tugas Singkat</h3>

            <form method="POST" action="/organize-app-ocean-blue/src/controllers/TaskController.php"
      enctype="multipart/form-data">
    <input type="text" name="title" class="input-field" placeholder="Judul tugas..." required>
    <textarea name="description" class="input-field" placeholder="Deskripsi tugas..." style="height:130px"></textarea>
    <input type="file" name="file" class="input-field">
    <button class="btn-primary" name="save_task">Simpan Tugas</button>
</form>
        </div>

        <div class="footer">© <?= date("Y") ?> Organize App</div>
    </div>

</div>

</body>
</html>
