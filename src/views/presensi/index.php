<?php
session_start();
require_once __DIR__ . '/../../core/auth.php';
if (!is_logged_in()) header("Location: ../auth/login.php");
?>
<h2>Halaman Presensi</h2>
<p>Presensi kegiatan organisasi di sini.</p>
<a href="../dashboard/main.php">⬅ Kembali</a>
