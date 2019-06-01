<?php
include "Conexion.php";

    $idusuario=$_POST['IdUsuario'];
    $Nombre = $_POST["Nombreu"]; $Nombre= strtoupper($Nombre); $Nombre= trim($Nombre);
    $ApellidoPat = $_POST["ApellidoPatu"]; $ApellidoPat= strtoupper($ApellidoPat); $ApellidoPat=trim($ApellidoPat);
    $ApellidoMat = $_POST["ApellidoMatu"]; $ApellidoMat= strtoupper($ApellidoMat); $ApellidoMat=trim($ApellidoMat);
    $Usuario = $_POST["Usuariou"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
    $Contra= $_POST["Contraseniau"]; $Contra= strtoupper($Contra); $Contra= trim($Contra);
    $Perfil = $_POST["Perfilu"];

    $sql_actualizar = "UPDATE usuario SET Nombres='$Nombre', ApellidoPaterno='$ApellidoPat', 
    ApellidoMaterno='$ApellidoMat', Usuario='$Usuario', Contrasenia='$Contra', IdPerfil='$Perfil' 
    WHERE IdUsuario='$idusuario'";
    $sentencia = $pdo->prepare($sql_actualizar);
    
    if ($sentencia->execute(array($Nombre,$ApellidoPat,$ApellidoMat,$Usuario,$Contra,$Perfil))) {
        echo 1;
    } else {
        echo 2;
    }
    
?>