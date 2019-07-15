<?php 
    require "Conexion.1.php";


    $Empresa=$_POST['ClaveEmpresa'];

    $sql= $pdo->prepare("SELECT Sucursal, Nombre FROM sucursal WHERE ClaveEmpresa = '$Empresa' ORDER BY Nombre");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

    $html= "<option value='0' selected disabled> Seleccione...</option>";

    foreach ($resultado as $fila) {
        $html.= "<option value='".$fila['Sucursal']."'>".$fila['Nombre']."</option>";
    }
    echo $html;


?>