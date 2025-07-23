<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../../config/db.php';

// Obtener plantas disponibles
$sql = "SELECT * FROM plantas WHERE stock > 0";
$resultado = $conn->query($sql);
$plantas = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Registrar Nueva Venta</h2>
    <form action="../../controllers/registrar_venta.php" method="POST">
        <div class="mb-3">
            <label for="planta_id" class="form-label">Planta</label>
            <select name="planta_id" id="planta_id" class="form-select" required>
                <?php foreach ($plantas as $planta): ?>
                    <option value="<?= $planta['id'] ?>">
                        <?= htmlspecialchars($planta['nombre']) ?> - S/.<?= number_format($planta['precio'], 2) ?> (Stock: <?= $planta['stock'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="../dashboard.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>