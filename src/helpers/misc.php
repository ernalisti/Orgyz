<?php
// src/helpers/misc.php
function flash($key, $value = null) {
    if (session_status() == PHP_SESSION_NONE) session_start();
    if ($value === null) {
        if (isset($_SESSION['flash'][$key])) {
            $v = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $v;
        }
        return null;
    } else {
        $_SESSION['flash'][$key] = $value;
    }
}
