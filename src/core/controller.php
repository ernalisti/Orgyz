<?php
// src/core/controller.php
class Controller {
    protected $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
}
