<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once '../../config/db.php';

if (!isset($_GET['id'])) {
    echo "ID de venta no especificado.";
    exit();
}

$id_venta = intval($_GET['id']);

$sql = "SELECT p.nombre, d.cantidad, d.precio_unitario
        FROM venta_detalle d
        JOIN plantas p ON d.id_planta = p.id
        WHERE d.id_venta = $id_venta";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>🧾 Detalle de Venta #<?= $id_venta ?></h2>
    <a href="ventas_historial.php" class="btn btn-secondary mb-3">← Volver</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        while ($detalle = $resultado->fetch_assoc()):
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($detalle['nombre']) ?></td>
                <td><?= $detalle['cantidad'] ?></td>
                <td>S/. <?= number_format($detalle['precio_unitario'], 2) ?></td>
                <td>S/. <?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr class="table-light">
                <th colspan="3" class="text-end">Total:</th>
                <th>S/. <?= number_format($total, 2) ?></th>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>