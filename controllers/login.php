<?php
session_start();
require_once '../config/db.php'; // conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    $sql = "SELECT u.*, r.nombre AS rol_nombre, r.id AS rol_id 
            FROM usuarios u 
            INNER JOIN roles r ON u.id_rol = r.id 
            WHERE u.correo = ? AND u.contrasena = ?
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'correo' => $usuario['correo'],
            'rol' => $usuario['rol_id'],
            'rol_nombre' => $usuario['rol_nombre']
        ];
        header("Location: ../views/dashboard.php");
    } else {
        $error = "Credenciales inválidas";
        header("Location: ../views/login.php?error=" . urlencode($error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../views/login.php");
}