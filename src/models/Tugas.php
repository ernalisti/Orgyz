<?php
// src/models/Tugas.php
require_once __DIR__ . '/../core/model.php';

class Tugas extends Model {
    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM tugas ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function create($title, $description, $file_path, $created_by) {
        $stmt = $this->pdo->prepare("INSERT INTO tugas (title, description, file_path, created_by, created_at) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$title, $description, $file_path, $created_by]);
    }
}
