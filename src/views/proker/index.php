<?php
session_start();
require_once __DIR__ . '/../../core/auth.php';
if (!is_logged_in()) header("Location: ../auth/login.php");
?>
<h2>Halaman Program Kerja</h2>
<p>Program kerja organisasi akan ditampilkan di sini.</p>
<a href="../dashboard/main.php">⬅ Kembali</a>
