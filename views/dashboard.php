<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

$usuario = $_SESSION['usuario'];
$nombre = $usuario['nombre'];
$rol = $usuario['rol']; // 1 = admin, 2 = vendedor, 3 = encargado

// Obtener el nombre del rol para mostrarlo
$nombreRol = ($rol == 1) ? 'Administrador' : (($rol == 2) ? 'Vendedor' : (($rol == 3) ? 'Encargado' : 'Desconocido'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Bienvenido, <?= htmlspecialchars($nombre) ?> (Rol: <?= $nombreRol ?>)</h2>
    <hr>

    <?php if ($rol == 1): // ADMIN ?>
        <div class="row">
            <div class="col-md-4">
                <a href="plantas_listar.php" class="btn btn-outline-success w-100 mb-3">🌿 Gestionar Plantas</a>
                <a href="usuarios_listar.php" class="btn btn-outline-primary w-100 mb-3">👥 Gestionar Usuarios</a>
                <a href="./ventas/ventas_historial.php" class="btn btn-outline-dark w-100 mb-3">📊 Ver Ventas</a>
            </div>
        </div>
    <?php elseif ($rol == 2): // VENDEDOR ?>
        <div class="row">
            <div class="col-md-4">
                <a href="plantas_listar.php" class="btn btn-outline-success w-100 mb-3">🌿 Ver Plantas</a>
                <a href="ventas/ventas_nueva.php" class="btn btn-outline-info w-100 mb-3">🛒 Registrar Venta</a>
            </div>
        </div>
    <?php elseif ($rol == 3): // ENCARGADO ?>
        <div class="row">
            <div class="col-md-4">
                <a href="plantas_listar.php" class="btn btn-outline-success w-100 mb-3">🌿 Gestionar Plantas</a>
                <!-- Puedes agregar aquí más accesos si lo deseas -->
            </div>
        </div>
    <?php endif; ?>

    <a href="../controllers/logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
</div>
</body>
</html>