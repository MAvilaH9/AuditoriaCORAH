<?php 
    require "Conexion.1.php";

    $Empresa=$_POST['ClaveEmpresa'];
    $perfil = 2;

    $sql= $pdo->prepare("SELECT * FROM usuario WHERE ClaveEmpresa='$Empresa' AND IdPerfil='$perfil' ORDER BY Nombres");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

    $html= "<option value='0' selected disabled> Seleccione...</option>";

    foreach ($resultado as $fila) {
        $html.= "<option value='".$fila['IdUsuario']."'>".$fila['ApellidoPaterno']."&nbsp;".$fila['ApellidoMaterno']."&nbsp;".$fila['Nombres']."</option>";
    }
    echo $html;


?>