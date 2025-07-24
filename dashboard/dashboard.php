<?php
session_start();

print_r($_SESSION);

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Bienvenido al dashboard</h1>
    <a href="../modelo/logout.php">Cerrar sesión</a>

    <script>
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            location.href = "../modelo/logout.php";
        };
    </script>
</body>

</html>