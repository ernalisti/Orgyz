<?php
session_start();
require_once __DIR__ . '/src/core/auth.php';

if (is_logged_in()) {
    header("Location: src/views/dashboard/main.php");
    exit;
} else {
    header("Location: src/views/auth/login.php");
    exit;
}
