
<?php
$fecha= date("d/m/Y");
header('Content-type:application/xls');
header("Content-Disposition:attachment; filename= Usuario_$fecha.xls");

require_once ("Conexion.php");
$sql= $pdo->prepare("SELECT IdUsuario, Usuario, Contrasenia FROM usuario ORDER BY IdUsuario ASC");
$sql->execute();
$resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
?>

<html>
<table border="1">
    <tr>
        <th>IdUsuario</th>
        <th>Usuario</th>
        <th>Contrasenia</th>
    </tr>
    <?php foreach ($resultado as $dato) {?>
    
    <tr>
        <td><?php echo $dato['IdUsuario'];?></td>
        <td><?php echo $dato['Usuario'];?></td>
        <td><?php echo $dato['Contrasenia'];?></td>
    </tr>
    <?php }?>
</table>
</html>