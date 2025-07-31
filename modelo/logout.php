<?php
session_start();
session_destroy();

// Elimina la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Evita que esta página se cachee también
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: ../login.php");
exit;

?>