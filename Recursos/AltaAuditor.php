<?php
require "Conexion.php";
$Nombre = $_POST["Nombre"]; $Nombre= strtoupper($Nombre); $Nombre= trim($Nombre);
$ApellidoPat = $_POST["ApellidoPat"]; $ApellidoPat= strtoupper($ApellidoPat); $ApellidoPat=trim($ApellidoPat);
$ApellidoMat = $_POST["ApellidoMat"]; $ApellidoMat= strtoupper($ApellidoMat); $ApellidoMat=trim($ApellidoMat);
$Usuario = $_POST["Usuario"]; $Usuario= strtoupper($Usuario); $Usuario=trim($Usuario);
$Contraseña= $_POST["Contrasenia"]; $Contraseña= strtoupper($Contraseña); $Contraseña= trim($Contraseña);
$Perfil = $_POST["Perfil"];

// Consulta para la validación del usuario
$Sql = 'SELECT * FROM usuario WHERE Usuario=?';
$Sentencia = $pdo->prepare($Sql);
$Sentencia->execute(array($Usuario));
$Resultado = $Sentencia->fetch();
$nom=$Resultado['Nombres'];
$ap=$Resultado['ApellidoPaterno'];
$am=$Resultado['ApellidoMaterno'];
$us=$Resultado['Usuario'];
$cont=$Resultado['Contrasenia'];
$Per=$Resultado['IdPerfil'];

if ($nom==$Nombre && $ap=$ApellidoPat && $am==$ApellidoMat || $Usuario == $us && $Contraseña == $cont && $Per=$Perfil) {
    echo 3;
}else{
    // $sql = "INSERT INTO usuario (Usuario, Contrasenia) VALUES (?,?)";
    // echo mysqli_query($Conexion, $sql);


    $sql_agregar = 'INSERT INTO usuario (Nombres, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasenia, ClaveEmpresa, IdPerfil) VALUES (?,?,?,?,?,NULL,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);

    if ($sentencia_agregar->execute(array($Nombre, $ApellidoPat, $ApellidoMat, $Usuario, $Contraseña, $Perfil))) {
        echo 1;
    } else {
        echo 2;
        die();
    }
}
?>

