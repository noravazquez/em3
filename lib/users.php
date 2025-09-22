<?php
function getAllUsers($db, $id_rol)
{
    if ($id_rol == 1) {
        $stmt = $db->query("SELECT u.id_usuario, u.contrasena, u.id_rol_fk, r.rol, u.usuario, u.estado
            FROM usuario u
            JOIN rol r ON u.id_rol_fk = r.id_rol
            WHERE u.estado = 'A'");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

function getUserById($db, $id_rol, $id_usuario)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("SELECT u.id_usuario, u.contrasena, u.id_rol_fk, r.rol, u.usuario, u.estado
            FROM usuario u
            JOIN rol r ON u.id_rol_fk = r.id_rol
            WHERE u.estado = 'A' AND u.id_usuario = :id_usuario LIMIT 1");
        $stmt->execute(['id_usuario' => $id_usuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

function addUser($db, $data, $id_rol)
{
    if ($id_rol == 1) {

        $check = $db->prepare("SELECT COUNT(*) FROM usuario WHERE usuario = :usuario");
        $check->execute(['usuario' => $data['usuario']]);
        if ($check->fetchColumn() > 0) {
            return false;
        }

        // 2️⃣ Insertar nuevo usuario
        $stmt = $db->prepare("INSERT INTO usuario (
            contrasena, id_rol_fk, usuario)
            VALUES (:contrasena, :id_rol_fk, :usuario)");

        return $stmt->execute([
            'contrasena' => password_hash($data['contrasena'], PASSWORD_DEFAULT),
            'id_rol_fk' => $data['id_rol'],
            'usuario' => $data['usuario']
        ]);
    }
}

function updateUser($db, $data, $id_rol)
{
    if ($id_rol == 1) {
        if (!empty($data['contrasena'])) {
            $stmt = $db->prepare("UPDATE usuario
            SET contrasena=:contrasena, id_rol_fk=:id_rol_fk, usuario=:usuario
            WHERE id_usuario=:id_usuario");
            return $stmt->execute([
                'contrasena' => password_hash($data['contrasena'], PASSWORD_DEFAULT),
                'id_rol_fk' => $data['id_rol_fk'],
                'usuario' => $data['usuario'],
                'id_usuario' => $data['id_usuario']
            ]);
        } else {
            $stmt = $db->prepare("UPDATE usuario
            SET id_rol_fk=:id_rol_fk, usuario=:usuario
            WHERE id_usuario=:id_usuario");
            return $stmt->execute([
                'id_rol_fk' => $data['id_rol_fk'],
                'usuario' => $data['usuario'],
                'id_usuario' => $data['id_usuario']
            ]);
        }
    }
}

function deleteUser($db, $id_rol, $id_usuario)
{
    if ($id_rol == 1) {
        $stmt = $db->prepare("
            UPDATE usuario
            SET estado = 'I' 
            WHERE id_usuario = :id_usuario
        ");
        return $stmt->execute([
            'id_usuario' => $id_usuario
        ]);
    }
}
