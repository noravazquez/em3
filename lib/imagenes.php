<?php
function getImagesByProject($db, $id_proyecto, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("SELECT * FROM imagenes WHERE id_proyecto_fk = :id_proyecto_fk");
    } else {
        $stmt = $db->prepare("SELECT * FROM imagenes WHERE id_proyecto_fk = :id_proyecto_fk AND estado = 'A'");
    }
    $stmt->execute(['id' => $id_proyecto]);
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
        $stmt = $db->prepare("
        DELETE FROM imagenes
            WHERE id_imagen = :id_imagen
        ");
        $result = $stmt->execute([
            'id'      => $id_imagen
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
            'id'      => $id_imagen,
            'usuario' => $id_usuario,
        ]);
    }
    return $result;
}
