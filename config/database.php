<?php
    $host = 'localhost';
    $port = '3306';  // Puerto por defecto de MySQL
    $dbname = 'em3';
    $user = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>