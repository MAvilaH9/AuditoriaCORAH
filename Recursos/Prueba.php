<?php 
    require "Conexion.php";


    $id=$_POST['id_estado'];

    $sql= $pdo->prepare("SELECT id_municipio, municipio FROM t_municipio WHERE id_estado = '$id' ORDER BY municipio");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

    $html= "<option value='0' selected disabled> Seleccione Categoría...</option>";

    foreach ($resultado as $fila) {
        $html.= "<option value='".$fila['id_municipio']."'>".$fila['municipio']."</option>";
    }
    echo $html;


?>