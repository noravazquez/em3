<?php
require_once "../../../config/database.php";
require_once "../../../lib/auth.php";
require_once "../../../lib/users.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!checkAuth()) {
    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['id_rol'] != 1) {
    header("Location: ../../logout.php");
    exit;
}

$id_usuario = $_GET['id'] ?? null;

if (!$id_usuario) {
    header("Location: ../user_list.php?error=Proyecto no encontrado");
    exit();
}

if (deleteUser($db, $_SESSION['id_rol'], $id_usuario)) {
    header("Location: ../user_list.php?success=Usuario eliminado");
} else {
     header("Location: ../user_list.php?error=Error al eliminar usuario");
}

exit();