<?php
    session_start();
    require "Conexion_Auditoria.php";

    if (isset($_POST['operation'])) {
        
        if ($_POST["operation"] == "Add") {

            $Nombre = $_POST["NombreEmpresa"]; $Nombre= trim($Nombre);
            $BD = $_POST["NombreBD"]; $BD=trim($BD);

                $sql_agregar = 'INSERT INTO Empresa (NombreEmpresa, NombreBaseDatos) 
                VALUES (?,?)';
                $sentencia_agregar = $pdo->prepare($sql_agregar);

                if ($sentencia_agregar->execute(array($Nombre, $BD))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                }        
            // }
        }

        if ($_POST["operation"] == "Edit") {

            $IdEmpresa=$_POST['IdEmpresa'];
            $Nombre = $_POST["NombreEmpresa"]; $Nombre= trim($Nombre);
            $BD = $_POST["NombreBD"]; $BD=trim($BD);


            $sql_actualizar = "UPDATE Empresa SET NombreEmpresa='$Nombre', NombreBaseDatos='$BD'
            WHERE IdEmpresa='$IdEmpresa'";
            $sentencia = $pdo->prepare($sql_actualizar);
            
            if ($sentencia->execute(array($Nombre, $BD))) {
                echo 1;
            } else {
                echo 2;
                die();
            }
        }
    }
?>

