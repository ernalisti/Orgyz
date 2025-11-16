<?php
// src/models/User.php
require_once __DIR__ . '/../core/model.php';

class User extends Model {
    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($username, $passwordHash, $role='staf') {
        $stmt = $this->pdo->prepare("INSERT INTO users (username,password,role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $passwordHash, $role]);
    }
}
