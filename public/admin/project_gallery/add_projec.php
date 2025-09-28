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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nombre'           => $_POST['nombre'],
        'descripcion'      => $_POST['descripcion'],
        'usuario_creacion' => $_SESSION['id_usuario']
    ];

    if (addProject($db, $data)) {
        $id_proyecto = $db->lastInsertId('proyectos_id_proyecto_seq');

        $upload_dir = __DIR__ . "./uploads/proyectos/" . $id_proyecto . "/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $maxSize = 20 * 1024 * 1024;

        $fecha = date("Ymd");
        $contador = 1;

        if (!empty($_FILES['imagenes']['name'][0])) {
            foreach ($_FILES['imagenes']['tmp_name'] as $i => $tmpFile) {
                if ($_FILES['imagenes']['error'][$i] === UPLOAD_ERR_OK) {
                    $fileType = mime_content_type($tmpFile);
                    $fileSize = $_FILES['imagenes']['size'][$i];

                    if (!in_array($fileType, $allowedTypes)) {
                        header("Location: ../project_gallery.php?error=Formato no permitido."); //ARREGLAR DIRECCIONES Y LOS MENSAJES PLISSSS
                        exit();
                    }
                    if ($fileSize > $maxSize) {
                        header("Location: ../project_gallery.php?error=Imagen demasiado grande.");
                        exit();
                    }

                    $extension = strtolower(pathinfo($_FILES['imagenes']['name'][$i], PATHINFO_EXTENSION));

                    $nombre_final = uniqid() . "_" . "img_{$id_proyecto}_{$fecha}_{$contador}." . $extension;

                    if (move_uploaded_file($tmpFile, $upload_dir . $nombre_final)) {
                        addImage($db, $id_proyecto, $nombre_final, $_SESSION['id_usuario']);
                    }

                    $contador++;
                }
            }
        }
        header("Location: ../project_gallery.php?success=Proyecto guardado correctamente.");
        exit();
    } else {
        header("Location: ../project_gallery.php?error=Error al guardar el proyecto.");
        exit();
    }
}