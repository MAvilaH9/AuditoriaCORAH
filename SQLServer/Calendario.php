<?php
    session_start();
    require "Conexion.php";

    if (isset($_POST['operation'])) {

        if ($_POST["operation"] == "Add") {

            if (!empty($_POST['Sucursal'])) {

                $Sucursal = $_POST['Sucursal'];
                $Almacen = $_POST['Almacen'];
                $Auditor = $_POST["Auditor"]; 
                $Fecha = $_POST['Fecha'];

                $sql_agregar = 'INSERT INTO CalendarioAuditar (Sucursal, Almacen, Usuario, Fecha) VALUES (?,?,?,?)';
                $sentencia_agregar = $pdo->prepare($sql_agregar);
    
                if ($sentencia_agregar->execute(array($Sucursal,$Almacen, $Auditor, $Fecha))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                } 
        
            }
            /*
            if (!empty($_POST['Almacen'])) {

                $Empresa = $_POST["Empresa"]; 
                $Almacen = $_POST['Almacen'];
                $Auditor = $_POST["Auditor"]; 
                $Fecha = $_POST['Fecha'];
    

                $sql_agregar = 'INSERT INTO Auditar (ClaveEmpresa, Sucursal, Almacen, IdUsuario, Fecha) VALUES (?,NULL,?,?,?)';
                $sentencia_agregar = $pdo->prepare($sql_agregar);
    
                if ($sentencia_agregar->execute(array($Empresa, $Almacen, $Auditor, $Fecha))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                }  
            } */
        }

        if ($_POST["operation"] == "Edit") {

            if (!empty($_POST['Sucursal']) ) {

                $IdAuditar = $_POST['IdAuditar'];
                $Almacen = $_POST["Almacen"]; 
                $Sucursal = $_POST["Sucursal"]; 
                $Auditor = $_POST["Auditor"]; 
                $Fecha = $_POST['Fecha'];
    
                $sql_actualizar = "UPDATE CalendarioAuditar SET Sucursal='$Sucursal', 
                Almacen='$Almacen', Usuario='$Auditor', Fecha='$Fecha'
                WHERE IdCalendarioAuditar='$IdAuditar'";
                $sentencia = $pdo->prepare($sql_actualizar);
                
                if ($sentencia->execute(array($Sucursal,$Almacen, $Auditor, $Fecha))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                }
            }
            /*
            if (!empty($_POST['Almacen'])) {

                $IdAuditar = $_POST['IdAuditar'];
                $Empresa = $_POST["Empresa"]; 
                $Almacen = $_POST['Almacen'];
                $Auditor = $_POST["Auditor"]; 
                $Fecha = $_POST['Fecha'];
    
                $sql_actualizar = "UPDATE Auditar SET ClaveEmpresa='$Empresa', 
                Almacen='$Almacen', IdUsuario='$Auditor', Fecha='$Fecha'
                WHERE IdAuditar='$IdAuditar'";
                $sentencia = $pdo->prepare($sql_actualizar);
                
                if ($sentencia->execute(array($Empresa, $Almacen, $Auditor, $Fecha))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                }
            }
            **/
        }
    }
?>

