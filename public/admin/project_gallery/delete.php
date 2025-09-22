<?php
require_once "../../../config/database.php";
require_once "../../../lib/auth.php";
require_once "../../../lib/projects.php";
require_once "../../../lib/imagenes.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!checkAuth()) {
    header("Location: ../../login.php");
    exit;
}

$id_proyecto = $_GET['id'] ?? null;

if (!$id_proyecto) {
    header("Location: ../project_gallery.php?error=Proyecto no encontrado");
    exit();
}

if (deleteProject($db, $id_proyecto)) {
    header("Location: ../project_gallery.php?success=Proyecto eliminado");
} else {
     header("Location: ../project_gallery.php?error=Error al eliminar proyecto");
}

exit();