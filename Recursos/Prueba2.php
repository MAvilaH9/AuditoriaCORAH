<?php
require "Conexion.php";

$id=$_POST['id_municipio'];

$sql= $pdo->prepare("SELECT id_localidad, localidad FROM t_localidad WHERE id_municipio = '$id' ORDER BY localidad");
$sql->execute();
$resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

$html= "<option value='0' selected disabled> Seleccione Rama</option>";

foreach ($resultado as $fila) {
    $html.= "<option value='".$fila['id_localidad']."'>".$fila['localidad']."</option>";
}
echo $html;

?>