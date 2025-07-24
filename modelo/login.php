<?php
session_start();
require_once '../config/connection.php';

$db = new Connection();
$conn = $db->connect();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; 

    if (empty($email) || empty($password)) {
        die("Por favor completa todos los campos.");
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $stmt = $conn->prepare("SELECT 1 FROM usuarios WHERE usuario = :email AND contrasena = crypt(:password, contrasena)");
        $stmt->execute(['email' => $email, 'password' => $password]);

        if ($stmt->fetchColumn()) {
            $_SESSION["id_usuario"] = $user["id_usuario"];
            $_SESSION["usuario"] = $user["usuario"];
            $_SESSION["id_rol"] = $user["id_rol_fk"];
            header("Location: ../dashboard/dashboard.php");
            exit;
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Acceso no permitido";
}

?>