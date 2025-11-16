<?php
// src/models/Proker.php
require_once __DIR__ . '/../core/model.php';

class Proker extends Model {
    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM proker ORDER BY id DESC");
        return $stmt->fetchAll();
    }
}
