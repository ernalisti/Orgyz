<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

if (isset($_POST['save_task'])) {

    $user_id = $_SESSION['user']['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $file_name = null;

    // Upload attachment jika ada
    if (!empty($_FILES['file']['name'])) {
        $file_name = time() . "_" . basename($_FILES['file']['name']);
        $path = __DIR__ . "/../../uploads/" . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $path);
    }

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, attachment)
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $file_name]);

    header("Location: ../views/dashboard/main.php?success=Tugas berhasil ditambahkan");
    exit;
}
