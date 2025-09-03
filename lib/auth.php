<?php
session_start();

function login($usuario, $password, $db)
{
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['contrasena'])) {
        $_SESSION["id_usuario"] = $user["id_usuario"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["id_rol"] = $user["id_rol_fk"];
        return true;
    }

    return false;
}

function checkAuth()
{
    return isset($_SESSION['usuario']);
}

function logout()
{
    session_destroy();

    // Elimina la cookie de sesión si existe
    if (ini_get("session.use_cookies")) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Evita que esta página se cachee también
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    header("Location: ./login.php");
    exit;
}
