<?php
require_once "../controllers/usuarios.php";

if (isset($_GET['id'])) {
    eliminarUsuario($_GET['id']);
}
header("Location: usuarios_listar.php");
exit;
?>