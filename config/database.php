<?php
    $host = 'localhost';
    $port = '5432';
    $dbname = 'em3_construcciones';
    $user = 'postgres';
    $password = '12345';

    try {
        $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>