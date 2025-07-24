<?php
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; 

    if (empty($email) || empty($password)) {
        die("Por favor completa todos los campos.");
    }

    $db = new Connection();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $stmt = $conn->prepare("SELECT 1 FROM usuarios WHERE usuario = :email AND contrasena = crypt(:password, contrasena)");
        $stmt->execute(['email' => $email, 'password' => $password]);

        if ($stmt->fetchColumn()) {
            session_start();
            $_SESSION["id_usuario"] = $user["id_usuario"];
            $_SESSION["usuario"] = $user["usuario"];
            echo "SUCCESS";
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