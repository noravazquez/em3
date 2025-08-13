<?php
require_once '../config/connection.php';

function obtenerCategorias()
{
    try {
        $db = new Connection();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM categorias");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en obtenerCategorias: " . $e->getMessage());
        return [];
    }
}
