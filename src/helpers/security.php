<?php
// src/helpers/security.php
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
