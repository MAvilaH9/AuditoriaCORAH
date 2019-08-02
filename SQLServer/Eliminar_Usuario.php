<?php
    session_start();
    require_once "Conexion.php";
    $FechaActual = date("d-m-Y H:i:s:v",time());

    // $id=$_POST['id'];

    $idusuario=$_POST['id'];
    $Estatus="BAJA";
    $sql_actualizar = "UPDATE Usuario SET Estatus='$Estatus', UltimoCambio='$FechaActual'
    WHERE Usuario='$idusuario'";
    $sentencia = $pdo->prepare($sql_actualizar);
    
    if ($sentencia->execute(array($Estatus))) {
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