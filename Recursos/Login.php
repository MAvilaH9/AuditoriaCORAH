<?php  
$Mensaje="";
session_start();
require_once "Conexion.php";

// Variables que recibe del formualario Login.
$Usuario= $_REQUEST['Usuario'];
$Usuario= strtoupper($Usuario);
$Contrasenia= $_REQUEST['Contrasenia'];

// Consulta para la validación del usuario
$Sql = 'SELECT * FROM usuario WHERE Usuario=?';
$Sentencia = $pdo->prepare($Sql);
$Sentencia->execute(array($Usuario));
$Resultado = $Sentencia->fetch();

$Resultado['Usuario'];
$Resultado['Contrasenia'];
$Resultado['IdPerfil'];

if ($Contrasenia == $Resultado['Contrasenia'] && $Resultado['Usuario'] == $Usuario) {
    $_SESSION['Usuario'] = $Resultado['Usuario'];
    $_SESSION['Perfil'] = $Resultado['IdPerfil'];

    header('location:../Interfaz/Index.php');

}else {
    
    header('location:../Interfaz/Login.php?Error=true');
}

?>