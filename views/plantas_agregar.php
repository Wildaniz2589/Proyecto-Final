<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
// ✅ Ahora permite acceso a Administrador (1) y Encargado (3)
if (!in_array($usuario['rol'], [1, 3])) {
    header("Location: dashboard.php");
    exit();
}

require_once '../config/db.php';

// Obtener categorías para el select
$sql = "SELECT * FROM categorias";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>➕ Agregar Nueva Planta</h2>

    <form action="../controllers/plantas_guardar.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Planta</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio (S/.)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" id="id_categoria" class="form-control" required>
                <option value="">Seleccione...</option>
                <?php while ($cat = $resultado->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Planta</button>
        <a href="plantas_listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>