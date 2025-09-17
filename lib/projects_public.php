<?php
function getProjectsHome($db)
{
    $stmt = $db->query("SELECT 
            p.id_proyecto,
            p.nombre,
            p.descripcion
        FROM proyectos p
        WHERE p.estado = 'A'
        ORDER BY p.fecha_creacion DESC LIMIT 5");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProjects($db)
{
    $stmt = $db->query("SELECT 
            p.id_proyecto,
            p.nombre,
            p.descripcion
        FROM proyectos p
        WHERE p.estado = 'A'
        ORDER BY p.fecha_creacion DESC");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getImagesByProject($db, $id_proyecto)
{
    $stmt = $db->prepare("SELECT 
            i.id_imagen,
            i.nombre_archivo,
            i.id_proyecto_fk
        FROM imagenes i
        WHERE i.id_proyecto_fk = :id_proyecto_fk AND i.estado = 'A'");

    $stmt->execute(['id_proyecto_fk' => $id_proyecto]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
