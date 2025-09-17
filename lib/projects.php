<?php
function getAllProjects($db, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->query("SELECT 
                p.id_proyecto,
                p.nombre,
                p.descripcion,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN usuarios u ON p.usuario_creacion = u.id_usuario
            LEFT JOIN usuarios u2 ON p.usuario_modificacion = u2.id_usuario
            ORDER BY p.fecha_creacion DESC");
    } else {
        $stmt = $db->query("SELECT 
                p.id_proyecto,
                p.nombre,
                p.descripcion,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN usuarios u ON p.usuario_creacion = u.id_usuario
            LEFT JOIN usuarios u2 ON p.usuario_modificacion = u2.id_usuario
            WHERE p.estado = 'A' ORDER BY p.fecha_creacion DESC");
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProjectById($db, $id)
{
    $stmt = $db->prepare("SELECT 
                p.id_proyecto,
                p.nombre,
                p.descripcion,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN usuarios u ON p.usuario_creacion = u.id_usuario
            LEFT JOIN usuarios u2 ON p.usuario_modificacion = u2.id_usuario
            WHERE p.id_proyecto = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addProject($db, $data)
{
    $stmt = $db->prepare("INSERT INTO proyectos(nombre, descripcion, fecha_creacion, usuario_creacion) 
        VALUES (:nombre, :descripcion, CURRENT_TIMESTAMP, :usuario_creacion)");
    return $stmt->execute([
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'usuario_creacion' => $data['usuario_creacion']
    ]);
}

function updateProject($db, $data)
{
    $stmt = $db->prepare("UPDATE proyectos SET
        nombre = :nombre, 
        descripcion = :descripcion,
        fecha_modificacion = CURRENT_TIMESTAMP, 
        usuario_modificacion = :usuario_modificacion
        WHERE id_proyecto = :id_proyecto");
    return $stmt->execute([
        'id_proyecto' => $data['id_proyecto'],
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'usuario_modificacion' => $data['usuario_modificacion']
    ]);
}

function deleteProject($db, $id_proyecto, $id_usuario, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("SELECT id_imagen FROM imagenes WHERE id_proyecto_fk = :id_proyecto");
        $stmt->execute(["id_proyecto" => $id_proyecto]);
        $imagenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($imagenes as $img) {
            deleteImage($db, $img['id_imagen'], $id_usuario, $id_rol);
        }

        $stmt = $db->prepare("
            DELETE FROM proyectos WHERE id_proyecto = :id_proyecto
        ");
        $result = $stmt->execute([
            "id_proyecto" => $id_proyecto
        ]);

        $dirPath = __DIR__ . "/../public/admin/project_gallery/uploads/proyectos/" . $id_proyecto;
        if (is_dir($dirPath)) {
            array_map('unlink', glob("$dirPath/*.*")); 
            rmdir($dirPath);
        }
    } else {
        $stmt = $db->prepare("
            UPDATE proyectos
            SET estado = 'I',
            fecha_modificacion = CURRENT_TIMESTAMP,
            usuario_modificacion = :usuario_modificacion
            WHERE id_proyecto = :id_proyecto
        ");
        $result = $stmt->execute([
            "usuario_modificacion" => $id_usuario,
            "id_proyecto" => $id_proyecto
        ]);
        
        $stmt = $db->prepare("
            UPDATE imagenes
            SET estado = 'I',
                fecha_modificacion = CURRENT_TIMESTAMP,
                usuario_modificacion = :usuario_modificacion
            WHERE id_proyecto_fk = :id_proyecto
        ");
        $stmt->execute([
            "usuario_modificacion" => $id_usuario,
            "id_proyecto" => $id_proyecto
        ]);
    }
    return $result;
}
