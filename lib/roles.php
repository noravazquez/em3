<?php
function getAllRoles($db) {
    $stmt = $db->query("SELECT * FROM rol");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}