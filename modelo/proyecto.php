<?php
session_start();
require_once '../config/connection.php';

try {
    $db = new Connection();
    $conn = $db->connect();

    $stmt = $conn->prepare("INSERT INTO proyectos(nombre, descripcion, id_categoria_fk, fecha_creacion, usuario_creacion) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?)");
    $stmt->execute([
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['id_categoria'],
        $_SESSION['id_usuario']
    ]);
    $id_proyecto = $conn->lastInsertId('proyectos_id_proyecto_seq');

    $upload_dir = __DIR__ . "/../uploads/proyectos/" . $id_proyecto . "/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $fecha = date("Ymd");
    $contador = 1;

    foreach ($_FILES['imagenes']['tmp_name'] as $index => $tmp_name) {
        if ($_FILES['imagenes']['error'][$index] === UPLOAD_ERR_OK) {
            $extension = strtolower(pathinfo($_FILES['imagenes']['name'][$index], PATHINFO_EXTENSION));

            $nombre_final = "img_{$id_proyecto}_{$fecha}_{$contador}." . $extension;

            if (move_uploaded_file($tmp_name, $upload_dir . $nombre_final)) {
                $stmt = $conn->prepare("INSERT INTO imagenes(nombre_archivo, id_proyecto_fk, fecha_creacion, usuario_creacion) VALUES (?, ?, CURRENT_TIMESTAMP, ?)");
                $stmt->execute([$nombre_final, $id_proyecto, $_SESSION['id_usuario']]);
            }

            $contador++;
        }
    }

    header("Location: ../dashboard/project_gallery.php?exito=1");
    exit;
} catch (PDOException $e) {
    die("Error al guardar el proyecto: " . $e->getMessage());
}