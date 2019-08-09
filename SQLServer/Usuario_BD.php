<?php
    session_start();
    require "Conexion_Auditoria.php";

    if (isset($_POST['operation'])) {
        
        if ($_POST["operation"] == "Add") {

            $Nombre = $_POST["UsuarioBD"]; $Nombre= trim($Nombre);
            $Contrasenia = $_POST["Contrasenia"]; $Contrasenia= trim($Contrasenia);
            $Descripcion = $_POST["Descripcion"]; $Descripcion= trim($Descripcion);

            //La contraseña se pasa al hash(encriptacion)
            $Contrasenia = password_hash($Contrasenia, PASSWORD_DEFAULT);

                $sql_agregar = 'INSERT INTO UsuarioBD (Usuario, Contrasena, Descripcion) 
                VALUES (?,?,?)';
                $sentencia_agregar = $pdo->prepare($sql_agregar);

                if ($sentencia_agregar->execute(array($Nombre, $Contrasenia, $Descripcion))) {
                    echo 1;
                } else {
                    echo 2;
                    die();
                }        
            // }
        }

        if ($_POST["operation"] == "Edit") {

            $IdUsuarioBD=$_POST['IdUsuarioBD'];
            $Nombre = $_POST["UsuarioBD"]; $Nombre= trim($Nombre);
            $Contrasenia = $_POST["Contrasenia"]; $Contrasenia=trim($Contrasenia);
            $Descripcion = $_POST["Descripcion"]; $Descripcion=trim($Descripcion);

            $Contrasenia = password_hash($Contrasenia, PASSWORD_DEFAULT);

            $sql_actualizar = "UPDATE UsuarioBD SET Usuario='$Nombre', Contrasena='$Contrasenia',
            Descripcion='$Descripcion'
            WHERE IdUsuarioBD='$IdUsuarioBD'";
            $sentencia = $pdo->prepare($sql_actualizar);
            
            if ($sentencia->execute(array($Nombre, $Contrasenia,$Descripcion))) {
                echo 1;
            } else {
                echo 2;
                die();
            }
        }
    }
?>

