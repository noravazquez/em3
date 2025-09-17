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
    $data = [
        'usuario'           => $_POST['usuario'],
        'contrasena'        => $_POST['contrasena'],
        'id_rol'            => $_POST['id_rol']
    ];

    if (addUser($db, $data, $_SESSION['id_usuario'])) {
        header("Location: ../user_list.php?success=Usuario guardado correctamente.");
        exit();
    } else {
        header("Location: ../user_list.php?error=Error al guardar el usuario.");
        exit();
    }
}