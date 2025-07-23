<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once '../../config/db.php';

// Obtener las ventas con nombre de usuario
$sql = "SELECT v.id, v.fecha, v.total, u.nombre AS nombre_usuario
        FROM ventas v
        JOIN usuarios u ON v.id_usuario = u.id
        ORDER BY v.fecha DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>📊 Historial de Ventas</h2>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">Volver</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($venta = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $venta['id'] ?></td>
                <td><?= $venta['fecha'] ?></td>
                <td><?= htmlspecialchars($venta['nombre_usuario']) ?></td>
                <td>S/. <?= number_format($venta['total'], 2) ?></td>
                <td>
                    <a href="ventas_detalle.php?id=<?= $venta['id'] ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>