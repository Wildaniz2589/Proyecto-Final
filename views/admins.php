<?php
include '../config/conexion.php';

$query = "
    SELECT u.id, u.nombre, u.correo, r.nombre AS rol
    FROM usuarios u
    JOIN roles r ON u.id_rol = r.id
    WHERE r.nombre = 'Administrador';
";

$result = mysqli_query($conexion, $query);
?>

<h2>Lista de Administradores</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td>
                <a href="../controllers/editar_usuario.php?id=<?php echo $row['id']; ?>">Editar</a> |
                <a href="../controllers/eliminar_usuario.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este administrador?');">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>