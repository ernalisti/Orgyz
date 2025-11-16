<?php
// src/helpers/file.php
function safe_filename($name) {
    $name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $name);
    return $name;
}
