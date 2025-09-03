<?php
function getAllCategories($db)
{
    $stmt = $db->query("SELECT * FROM categorias");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>