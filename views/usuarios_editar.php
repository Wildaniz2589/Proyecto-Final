<?php
session_start();
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: usuarios_listar.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Obtener roles
$roles = $conn->query("SELECT * FROM roles");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>✏️ Editar Usuario</h2>

    <form action="../controllers/usuarios_actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $usuario['nombre'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" value="<?= $usuario['correo'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" name="contrasena" class="form-control" value="<?= $usuario['contrasena'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="id_rol" class="form-select" required>
                <?php while ($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['id'] ?>" <?= $usuario['id_rol'] == $r['id'] ? 'selected' : '' ?>>
                        <?= $r['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="usuarios_listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>