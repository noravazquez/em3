<?php
require_once "../../../config/database.php";
require_once "../../../lib/auth.php";
require_once "../../../lib/users.php";
require_once "../../../lib/roles.php";

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'] ?? null;

    if (!$id_usuario) {
        header("Location: ../user_list.php?error=Usuario no encontrado");
        exit();
    }
    $data = [
        'id_usuario' => $id_usuario,
        'usuario' => $_POST['usuario'],
        'contrasena' => $_POST['nueva-contrasena'] ?? null,
        'id_rol_fk' => $_POST['id_rol']
    ];

    if (updateUser($db, $data, $_SESSION['id_rol'])) {
        header("Location: ../user_list.php?success=Usuario actualizado");
        exit();
    } else {
        header("Location: ../user_list.php?id=$id_usuario&error=Error al actualizar");
        exit();
    }
}