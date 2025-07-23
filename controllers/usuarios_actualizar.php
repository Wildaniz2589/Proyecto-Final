<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol'];

    $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contrasena = ?, id_rol = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $correo, $contrasena, $id_rol, $id);
    $stmt->execute();

    header("Location: ../views/usuarios_listar.php");
    exit();
}