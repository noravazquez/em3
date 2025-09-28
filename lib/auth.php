<?php
session_start();

// Tiempo máximo de inactividad en segundos (por ejemplo, 15 minutos)
$tiempo_maximo = 3600;

if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_inactivo = time() - $_SESSION['ultimo_acceso'];
    if ($tiempo_inactivo > $tiempo_maximo) {
        // Expiró la sesión
        session_unset();
        session_destroy();
        // Elimina la cookie de sesión si existe
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        // Evita que esta página se cachee también
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Location: ../login.php?timeout=1");
        exit();
    }
}

$_SESSION['ultimo_acceso'] = time();

function login($usuario, $password, $db)
{
    $stmt = $db->prepare("SELECT * FROM usuario WHERE usuario = :usuario LIMIT 1");
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
