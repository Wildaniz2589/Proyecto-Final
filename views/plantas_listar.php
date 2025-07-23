<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $usuario['rol'];

// ✅ SOLO RESTRINGIMOS A USUARIOS NO AUTORIZADOS (si hubiera rol 4 o algo extraño)
if (!in_array($rol, [1, 2, 3])) {
    header("Location: dashboard.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT p.*, c.nombre AS categoria FROM plantas p 
        JOIN categorias c ON p.id_categoria = c.id";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Plantas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">🌿 Listado de Plantas</h2>

    <!-- Agregar solo visible para Admin y Encargado -->
    <?php if ($rol == 1 || $rol == 3): ?>
        <a href="plantas_agregar.php" class="btn btn-success mb-3">➕ Agregar Planta</a>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <?php if ($rol == 1 || $rol == 3): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['categoria'] ?></td>
                    <td>S/. <?= number_format($row['precio'], 2) ?></td>
                    <td><?= $row['stock'] ?></td>
                    <?php if ($rol == 1 || $rol == 3): ?>
                        <td>
                            <a href="plantas_editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                            <a href="../controllers/plantas_eliminar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta planta?')">🗑️ Eliminar</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary mt-3">⬅️ Volver al Panel</a>
</div>
</body>
</html>