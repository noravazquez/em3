<?php
function getAllProjects($db, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->query("SELECT 
                p.id_proyecto,
                p.nombre,
                p.descripcion,
                c.id_categoria,
                c.categoria,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN categorias c ON p.id_categoria_fk = c.id_categoria
            INNER JOIN usuarios u ON p.usuario_creacion = u.id_usuario
            LEFT JOIN usuarios u2 ON p.usuario_modificacion = u2.id_usuario
            ORDER BY p.fecha_creacion DESC");
    } else {
        $stmt = $db->query("SELECT 
                p.id_proyecto,
                p.nombre,
                p.descripcion,
                c.id_categoria,
                c.categoria,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN categorias c ON p.id_categoria_fk = c.id_categoria
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
                c.id_categoria,
                c.categoria,
                p.fecha_creacion,
                p.fecha_modificacion,
                u.usuario AS usuario_creador,
                u2.usuario AS usuario_modificador,
                p.estado
            FROM proyectos p
            INNER JOIN categorias c ON p.id_categoria_fk = c.id_categoria
            INNER JOIN usuarios u ON p.usuario_creacion = u.id_usuario
            LEFT JOIN usuarios u2 ON p.usuario_modificacion = u2.id_usuario
            WHERE p.id_proyecto = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addProject($db, $data)
{
    $stmt = $db->prepare("INSERT INTO proyectos(nombre, descripcion, id_categoria_fk, fecha_creacion, usuario_creacion) 
        VALUES (:nombre, :descripcion, :id_categoria_fk, CURRENT_TIMESTAMP, :usuario_creacion)");
    return $stmt->execute([
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'id_categoria_fk' => $data['id_categoria_fk'],
        'usuario_creacion' => $data['usuario_creacion']
    ]);
}

function updateProject($db, $data)
{
    $stmt = $db->prepare("UPDATE proyectos SET
        nombre = :nombre, 
        descripcion = :descripcion, 
        id_categoria_fk = :id_categoria_fk, 
        fecha_modificacion = CURRENT_TIMESTAMP, 
        usuario_modificacion = :usuario_modificacion
        WHERE id_proyecto = :id_proyecto");
    return $stmt->execute([
        'id_proyecto' => $data['id_proyecto'],
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'id_categoria_fk' => $data['id_categoria_fk'],
        'usuario_modificacion' => $data['usuario_modificacion']
    ]);
}

function deleteProject($db, $id_proyecto, $id_usuario, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("
            DELETE FROM proyectos WHERE id_proyecto = :id_proyecto
        ");
        $result = $stmt->execute([
            "id_proyecto" => $id_proyecto
        ]);
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
    }
    return $result;
}
