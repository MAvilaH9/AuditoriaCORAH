<?php 
    require "Conexion.php";


    $Empresa=$_POST['ClaveEmpresa'];

    $sql= $pdo->prepare("SELECT Almacen, Nombre FROM Almacen WHERE ClaveEmpresa = '$Empresa' ORDER BY Nombre");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

    $html= "<option value='0' selected disabled> Seleccione...</option>";

    foreach ($resultado as $fila) {
        $html.= "<option value='".$fila['Almacen']."'>".$fila['Nombre']."</option>";
    }
    echo $html;


?>