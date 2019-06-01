<?php
session_start();
include "Conexion.php";
$Usuario = $_SESSION['Usuario'];
$Sentencia=$pdo->prepare("TRUNCATE visualizado");
$Sentencia -> execute();
$_SESSION = array();

if (ini_get("sesion.use_cookies")) {
    $param = session_get_cookie_params();
    setcookie(session_name(),'', time() - 42000,
        $param["path"], $param["domain"],
        $param["secure"], $param["httponly"]
    );
}

session_destroy();

header('location:../Interfaz/Login.php');
?>