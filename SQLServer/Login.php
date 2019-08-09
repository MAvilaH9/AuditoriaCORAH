<?php  
    $Mensaje="";
    // session_start();
    require_once "Conexion.php";

    // Variables que recibe del formualario Login.
    $Usuario= $_REQUEST['Usuario'];
    $Usuario= strtoupper($Usuario);
    $Contrasenia= $_REQUEST['Contrasenia'];

    if ($_SESSION['NombreEmpresa'] != "AUDITORIA") {

        // Consulta para la validación del usuario
        $Sql = "SELECT * FROM Usuario WHERE Usuario=? AND Estatus='ALTA' AND GrupoTrabajo ='Auditoria'";
        $Sentencia = $pdo->prepare($Sql);
        $Sentencia->execute(array($Usuario));
        $Resultado = $Sentencia->fetch();

        $Resultado['Usuario'];
        $Resultado['Contrasena'];
        $Resultado['Perfil'];
        $Resultado['ClaveEmpresa'];

        if ($Resultado['Acceso']=="_JEFEAUDIT" || $Resultado['Perfil']=="_JEFEAUDIT") {
            $Perfil=1;
        } else {
            $Perfil=2;
        }

        if ($Contrasenia==$Resultado['Contrasena'] && $Usuario==$Resultado['Usuario']) {

            $_SESSION['Usuario'] = $Resultado['Usuario'];
            $_SESSION['Perfil'] = $Perfil;

            header('location:../Interfaz/Index.php');

        }else {
            header('location:../Interfaz/Login.php?Error=true');
        }
    } else {

        // Consulta para la validación del usuario
        $Sql = "SELECT * FROM Usuario WHERE Usuario=?";
        $Sentencia = $pdo->prepare($Sql);
        $Sentencia->execute(array($Usuario));
        $Resultado = $Sentencia->fetch();

        $Resultado['Usuario'];
        $Resultado['Contrasena'];
        $Resultado['Perfil'];
        $Resultado['ClaveEmpresa'];

        if (password_verify($Contrasenia,$Resultado['Contrasena']) && $Usuario==$Resultado['Usuario']) {

            $_SESSION['Usuario'] = $Resultado['Usuario'];
            $_SESSION['Perfil'] = 1;

            header('location:../Interfaz/Index.php');

        }else {
            header('location:../Interfaz/Login.php?Error=true');
        }
    }

?>