<?php
// src/core/auth.php
if (session_status() == PHP_SESSION_NONE) session_start();

function is_logged_in() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}

function login_user($id, $username, $role) {
    $_SESSION['user'] = [
        'id' => $id,
        'username' => $username,
        'role' => $role
    ];
    // regenerate id for security
    session_regenerate_id(true);
}

function logout_user() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: /organize-app/public/index.php");
    exit;
}
