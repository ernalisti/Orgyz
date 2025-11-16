<?php
require_once __DIR__ . '/../config/database.php';
session_start();

/*
|--------------------------------------------------------------------------
| REGISTER USER
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] === 'register') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // Validasi field kosong
    if ($username === "" || $password === "") {
        header("Location: ../views/auth/register.php?error=Field tidak boleh kosong");
        exit;
    }

    // Validasi format email (hapus bagian ini jika username bukan email)
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/auth/register.php?error=Format email tidak valid");
        exit;
    }

    try {
        // Cek apakah username sudah terdaftar
        $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $check->execute([$username]);

        if ($check->fetch()) {
            header("Location: ../views/auth/register.php?error=Username sudah terdaftar");
            exit;
        }

        // Hash password
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashed, $role]);

        header("Location: ../views/auth/login.php?success=Registrasi berhasil, silakan login");
        exit;

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate key exception
            header("Location: ../views/auth/register.php?error=Username sudah digunakan");
            exit;
        }

        header("Location: ../views/auth/register.php?error=Registrasi gagal, coba lagi");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| LOGIN USER
|--------------------------------------------------------------------------
*/
if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Cek input kosong
    if ($username === "" || $password === "") {
        header("Location: ../views/auth/login.php?error=Field tidak boleh kosong");
        exit;
    }

    // Ambil user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {

        $_SESSION["user"] = [
            "id"       => $user["id"],
            "username" => $user["username"],
            "role"     => $user["role"]
        ];

        header("Location: ../views/dashboard/main.php");
        exit;

    } else {
        header("Location: ../views/auth/login.php?error=Login gagal, akun tidak ditemukan");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| LOGOUT USER
|--------------------------------------------------------------------------
*/
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/auth/login.php?success=Berhasil logout");
    exit;
}
