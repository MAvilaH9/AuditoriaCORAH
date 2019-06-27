<?php
    session_start();
    require "Conexion.php";

    if (isset($_POST['operation'])) {

        if ($_POST["operation"] == "Add") {

            $Empresa = $_POST["Empresa"]; 
            $Sucursal = $_POST["Sucursal"]; 
            $Auditor = $_POST["Auditor"]; 
            $Fecha = $_POST['Fecha'];

            $sql_agregar = 'INSERT INTO auditar (ClaveEmpresa, Sucursal, IdUsuario, Fecha) VALUES (?,?,?,?)';
            $sentencia_agregar = $pdo->prepare($sql_agregar);

            if ($sentencia_agregar->execute(array($Empresa, $Sucursal, $Auditor, $Fecha))) {
                    echo 1;
            } else {
                echo 2;
                die();
            }        
        }

        if ($_POST["operation"] == "Edit") {
            $IdAuditar = $_POST['IdAuditar'];
            $Empresa = $_POST["Empresa"]; 
            $Sucursal = $_POST["Sucursal"]; 
            $Auditor = $_POST["Auditor"]; 
            $Fecha = $_POST['Fecha'];

            $sql_actualizar = "UPDATE usuario SET  ClaveEmpresa='$Empresa', 
            Sucursal='$Sucursal', IdUsuario='$Auditor', Fecha='$Fecha'' 
            WHERE IdAuditar='$IdAuditar'";
            $sentencia = $pdo->prepare($sql_actualizar);
            
            if ($sentencia->execute(array($Empresa, $Sucursal, $Auditor, $Fecha))) {
                echo 1;
            } else {
                echo 2;
                die();
            }
        }
    }
?>

