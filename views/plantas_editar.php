<?php
session_start();
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['rol'], [1, 3])) {
    header("Location: dashboard.php");
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: plantas_listar.php");
    exit();
}

$id = $_GET['id'];

// Obtener la planta
$sql = "SELECT * FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$planta = $resultado->fetch_assoc();

if (!$planta) {
    echo "❌ Planta no encontrada.";
    exit();
}

// Obtener categorías
$categorias = $conn->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>✏️ Editar Planta</h2>

    <form action="../controllers/plantas_actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $planta['id'] ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Planta</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $planta['nombre'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio (S/.)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="<?= $planta['precio'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= $planta['stock'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" id="id_categoria" class="form-control" required>
                <?php while ($cat = $categorias->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $planta['id_categoria'] ? 'selected' : '' ?>>
                        <?= $cat['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Planta</button>
        <a href="plantas_listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>