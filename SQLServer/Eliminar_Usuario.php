<?php
    session_start();
    require_once "Conexion.php";

    $id=$_POST['id'];

    $sql = "DELETE FROM Usuario WHERE IdUsuario=$id";
    $params = array($_POST['id']);
    $result = $pdo->prepare($sql);
    if ($result->execute($params)) {
        echo 1;
    }

?>