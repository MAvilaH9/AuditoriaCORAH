<?php
    session_start();
    require "Conexion.php";
    date_default_timezone_set('America/Mexico_City');
    $FechaActual = date("d-m-Y H:i:s:v",time());

    if (isset($_POST['operation'])) {
        
        if ($_POST["operation"] == "Add") {

            $Nombre = $_POST["Nombre"]; $Nombre= ucwords($Nombre); $Nombre= trim($Nombre);
            $ApellidoPat = $_POST["ApellidoPat"]; $ApellidoPat= ucwords($ApellidoPat); $ApellidoPat=trim($ApellidoPat);
            $ApellidoMat = $_POST["ApellidoMat"]; $ApellidoMat= ucwords($ApellidoMat); $ApellidoMat=trim($ApellidoMat);
            $Usuario = $_POST["Usuario"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
            $Contraseña= $_POST["Contrasenia"]; $Contraseña= trim($Contraseña);
            $Perfil = $_POST["Perfil"];
            $Estatus="ALTA";
            $Departamento=$_POST['Departamento'];
            $GpoTrabajo="Auditoria";
            $Auditor= $Nombre." ".$ApellidoPat." ".$ApellidoMat;
            // $Contraseña=md5($Contraseña);
            // $Contraseña = password_hash($Contraseña, PASSWORD_DEFAULT);


            $sql_agregar = 'INSERT INTO Usuario (Nombre, Usuario, GrupoTrabajo, Departamento, Contrasena, Estatus, Alta, Acceso) 
            VALUES (?,?,?,?,?,?,?,?)';
            $sentencia_agregar = $pdo->prepare($sql_agregar);

            if ($sentencia_agregar->execute(array($Auditor, $Usuario, $GpoTrabajo, $Departamento, $Contraseña, $Estatus, $FechaActual, $Perfil))) {
                echo 1;
             } else {
                echo 2;
                die();
            }        
        }

        if ($_POST["operation"] == "Edit") {

            $idusuario=$_POST['IdUsuario'];
            $Nombre = $_POST["NombreEdit"]; $Nombre= ucwords($Nombre); $Nombre= trim($Nombre);
            $Usuario = $_POST["Usuario"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
            $Contra= $_POST["Contrasenia"]; $Contra= trim($Contra);
            $Perfil = $_POST["Perfil"];
            $Departamento = $_POST['Departamento'];
            // $Contra=md5($Contra);
            // $Contra = password_hash($Contra, PASSWORD_DEFAULT);

            $sql_actualizar = "UPDATE Usuario SET Nombre='$Nombre', Usuario='$Usuario', Contrasena='$Contra', 
            Departamento='$Departamento', UltimoCambio='$FechaActual', Acceso='$Perfil' 
            WHERE Usuario='$idusuario'";
            $sentencia = $pdo->prepare($sql_actualizar);
            
            if ($sentencia->execute(array($Nombre, $Usuario, $Contra, $Departamento, $FechaActual, $Perfil))) {
                echo 1;
            } else {
                echo 2;
                die();
            }
        }
    }
?>

