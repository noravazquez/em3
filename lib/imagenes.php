<?php
function getImagesByProject($db, $id_proyecto, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("SELECT 
            i.id_imagen,
            i.nombre_archivo,
            i.id_proyecto_fk,
            i.fecha_creacion,
            i.fecha_modificacion,
            u.usuario AS usuario_creador,
            u2.usuario AS usuario_modificador,
            i.estado
        FROM imagenes i
        INNER JOIN usuarios u ON i.usuario_creacion = u.id_usuario
        LEFT JOIN usuarios u2 ON i.usuario_modificacion = u2.id_usuario 
        WHERE i.id_proyecto_fk = :id_proyecto_fk");
    } else {
        $stmt = $db->prepare("SELECT 
            i.id_imagen,
            i.nombre_archivo,
            i.id_proyecto_fk,
            i.fecha_creacion,
            i.fecha_modificacion,
            u.usuario AS usuario_creador,
            u2.usuario AS usuario_modificador,
            i.estado
        FROM imagenes i
        INNER JOIN usuarios u ON i.usuario_creacion = u.id_usuario
        LEFT JOIN usuarios u2 ON i.usuario_modificacion = u2.id_usuario 
        WHERE i.id_proyecto_fk = :id_proyecto_fk AND i.estado = 'A'");
    }
    $stmt->execute(['id_proyecto_fk' => $id_proyecto]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addImage($db, $id_proyecto, $filename, $id_usuario)
{
    $stmt = $db->prepare("
        INSERT INTO imagenes (nombre_archivo, id_proyecto_fk, fecha_creacion, usuario_creacion)
        VALUES (:filename, :id_proyecto, CURRENT_TIMESTAMP, :usuario_creacion)
    ");
    return $stmt->execute([
        'filename'    => $filename,
        'id_proyecto' => $id_proyecto,
        'usuario_creacion'     => $id_usuario,
    ]);
}

function deleteImage($db, $id_imagen, $id_usuario, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("SELECT id_proyecto_fk, nombre_archivo FROM imagenes WHERE id_imagen = :id_imagen");
        $stmt->execute(['id_imagen' => $id_imagen]);
        $imagen = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($imagen) {
            $filePath = __DIR__ . "/../public/admin/project_gallery/uploads/proyectos/" . $imagen['id_proyecto_fk'] . "/" . $imagen['nombre_archivo'];

            // Si existe el archivo, lo borramos
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $stmt = $db->prepare("
            DELETE FROM imagenes
            WHERE id_imagen = :id_imagen
        ");
        $result = $stmt->execute([
            'id_imagen' => $id_imagen
        ]);
    } else {
        $stmt = $db->prepare("
        UPDATE imagenes
            SET estado = 'I',
                fecha_modificacion = CURRENT_TIMESTAMP),
                usuario_modificacion = :usuario_modificacion
            WHERE id_imagen = :id_imagen
        ");
        $result = $stmt->execute([
            'id_imagen'      => $id_imagen,
            'usuario' => $id_usuario,
        ]);
    }
    return $result;
}
