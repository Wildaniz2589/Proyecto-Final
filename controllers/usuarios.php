<?php
require_once '../config/db.php';

function obtenerUsuarios() {
    global $conn;
    $sql = "SELECT u.id, u.nombre, u.correo, r.nombre AS rol
            FROM usuarios u
            JOIN roles r ON u.id_rol = r.id";
    return $conn->query($sql);
}
?>