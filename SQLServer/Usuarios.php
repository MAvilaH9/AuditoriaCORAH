<?php
    session_start();
    require "Conexion_Auditoria.php";

    if (isset($_POST['operation'])) {
        
        if ($_POST["operation"] == "Add") {

            $Nombre = $_POST["Nombre"]; $Nombre= ucwords($Nombre); $Nombre= trim($Nombre);
            $ApellidoPat = $_POST["ApellidoPat"]; $ApellidoPat= ucwords($ApellidoPat); $ApellidoPat=trim($ApellidoPat);
            $ApellidoMat = $_POST["ApellidoMat"]; $ApellidoMat= ucwords($ApellidoMat); $ApellidoMat=trim($ApellidoMat);
            $Usuario = $_POST["Usuario"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
            $Contraseña= $_POST["Contrasenia"]; $Contraseña= trim($Contraseña);
            $Perfil = "_JEFEAUDIT";
            $Empresa = $_SESSION['NombreEmpresa'];
            $Estatus="ALTA";
            $Contraseña = password_hash($Contraseña, PASSWORD_DEFAULT);

            $sql_agregar = 'INSERT INTO Usuario (Nombre, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasena, Perfil, Empresa, Estatus) 
            VALUES (?,?,?,?,?,?,?,?)';
            $sentencia_agregar = $pdo->prepare($sql_agregar);

            if ($sentencia_agregar->execute(array($Nombre, $ApellidoPat, $ApellidoMat, $Usuario, $Contraseña, $Perfil, $Empresa, $Estatus))) {
                echo 1;
            } else {
                echo 2;
                die();
            }        
        }

        if ($_POST["operation"] == "Edit") {

            $idusuario=$_POST['IdUsuario'];
            $Nombre = $_POST["Nombre"]; $Nombre= ucwords($Nombre); $Nombre= trim($Nombre);
            $ApellidoMat = $_POST["ApellidoMat"]; $ApellidoMat= ucwords($ApellidoMat); $Nombre= trim($ApellidoMat);
            $ApellidoPat = $_POST["ApellidoPat"]; $ApellidoPat= ucwords($ApellidoPat); $ApellidoPat= trim($ApellidoPat);
            $Usuario = $_POST["Usuario"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
            $Contra= $_POST["Contrasenia"]; $Contra= trim($Contra);
            $Contra = password_hash($Contra, PASSWORD_DEFAULT);

            $sql_actualizar = "UPDATE Usuario SET Nombre='$Nombre', ApellidoPaterno='$ApellidoPat',
            ApellidoMaterno='$ApellidoMat', Usuario='$Usuario', Contrasena='$Contra'
            WHERE IdUsuario='$idusuario'";
            $sentencia = $pdo->prepare($sql_actualizar);
            
            if ($sentencia->execute(array($Nombre, $ApellidoPat, $ApellidoMat, $Usuario, $Contra))) {
                echo 1;
            } else {
                echo 2;
                die();
            }
        }
    }
?>

