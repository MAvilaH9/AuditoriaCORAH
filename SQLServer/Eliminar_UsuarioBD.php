<?php
    session_start();
    require_once "Conexion_Auditoria.php";


    $IdUsuarioBD=$_POST['id'];

    $sql_Eliminar = "DELETE UsuarioBD WHERE IdUsuarioBD='$IdUsuarioBD'";
    $sentencia = $pdo->prepare($sql_Eliminar);
    
    if ($sentencia->execute(array($IdUsuarioBD))) {
        echo 1;
    } else {
        echo 2;
        die();
    }

    // $sql = "DELETE FROM Usuario WHERE Usuario=$id";
    // $params = array($_POST['id']);
    // $result = $pdo->prepare($sql);
    // if ($result->execute($params)) {
    //     echo 1;
    // }

?>