<?php
// src/controllers/DashboardController.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/auth.php';

// contoh: load data untuk dashboard - bisa di-extend
$userModel = new User($pdo);
