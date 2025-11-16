<?php
// src/models/Presensi.php
require_once __DIR__ . '/../core/model.php';

class Presensi extends Model {
    public function record($user_id, $type='masuk') {
        $stmt = $this->pdo->prepare("INSERT INTO presensi (user_id, type, created_at) VALUES (?, ?, NOW())");
        return $stmt->execute([$user_id, $type]);
    }
    public function getToday($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM presensi WHERE user_id=? AND DATE(created_at)=CURDATE() LIMIT 1");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }
}
