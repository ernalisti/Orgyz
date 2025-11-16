<?php
// src/controllers/TugasController.php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Tugas.php';
require_once __DIR__ . '/../core/auth.php';

if (!is_logged_in()) {
    header("Location: ../views/auth/login.php");
    exit;
}

$tugasModel = new Tugas($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_tugas'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $userId = $_SESSION['user']['id'];

    // basic file upload
    $uploadDir = __DIR__ . '/../../public/uploads/tugas/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $filePath = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['file']['tmp_name'];
        $name = time() . '_' . basename($_FILES['file']['name']);
        $target = $uploadDir . $name;
        if (move_uploaded_file($tmp, $target)) {
            $filePath = 'uploads/tugas/' . $name; // relative untuk disimpan DB
        }
    }

    $tugasModel->create($title, $desc, $filePath, $userId);
    header("Location: ../views/dashboard/main.php");
    exit;
}
