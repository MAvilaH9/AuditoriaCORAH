<?php  
    $Mensaje="";
    // session_start();
    require_once "Conexion.php";

    // Variables que recibe del formualario Login.
    $Usuario= $_REQUEST['Usuario'];
    $Usuario= strtoupper($Usuario);
    $Contrasenia= $_REQUEST['Contrasenia'];

    // Consulta para la validación del usuario
    $Sql = 'SELECT * FROM Usuario WHERE Usuario=?';
    $Sentencia = $pdo->prepare($Sql);
    $Sentencia->execute(array($Usuario));
    $Resultado = $Sentencia->fetch();

    $Resultado['Usuario'];
    $Resultado['Contrasena'];
    $Resultado['IdPerfil'];
    $Resultado['ClaveEmpresa'];

    if ($Resultado['Acceso']=="_JEFEAUDIT") {
        $Perfil=2;
    } else {
        $Perfil=2;
    }

    if ($Contrasenia == $Resultado['Contrasena'] && $Resultado['Usuario'] == $Usuario) {
        $_SESSION['Usuario'] = $Resultado['Usuario'];
        // $_SESSION['Perfil'] = $Resultado['IdPerfil'];
        $_SESSION['Perfil'] = $Perfil;
        $_SESSION['ClaveEmpresa'] = $Resultado['ClaveEmpresa'];
        $_SESSION['IdUsuario']=7;   

        header('location:../Interfaz/Index.php');

    }else {
        header('location:../Interfaz/Login1.php?Error=true');
    }
?>