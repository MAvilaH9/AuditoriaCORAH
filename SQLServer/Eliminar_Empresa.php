<?php
    session_start();
    require_once "Conexion_Auditoria.php";


    $IdEmpresa=$_POST['id'];

    $sql_Eliminar = "DELETE Empresa WHERE IdEmpresa='$IdEmpresa'";
    $sentencia = $pdo->prepare($sql_Eliminar);
    
    if ($sentencia->execute(array($IdEmpresa))) {
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