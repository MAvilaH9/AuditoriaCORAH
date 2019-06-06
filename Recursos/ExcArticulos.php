<?php
    session_start();
    require_once ("Conexion.php");

    if (isset($_GET['Sucursal'])) {

        $fecha= date("d/m/Y");
        $Sucursal=$_GET['Sucursal'];

        $sqlsuc = $pdo->prepare("SELECT Nombre FROM sucursal where Sucursal=$Sucursal");
        $sqlsuc -> execute(array($Sucursal));
        $resultadosuc = $sqlsuc->fetch();
        $NombSuc=$resultadosuc['Nombre'];

        header('Content-type:application/xls');
        header("Content-Disposition:attachment; filename= Articulos_$NombSuc _$fecha.xls");

        $sql= $pdo->prepare("SELECT * FROM articulo WHERE Sucursal='$Sucursal' ORDER BY Articulo ASC");
        $sql->execute();
        $resultado=$sql->fetchALL(PDO::FETCH_ASSOC); ?>

        <html>
            <table border="1">
                <tr>
                    <th>Articulo</th>
                    <th>Descripción</th>
                    <th>Precio Lista</th>
                </tr>
                <?php foreach ($resultado as $dato) {?>

                <tr>
                    <td><?php echo $dato['Articulo'];?></td>
                    <td><?php echo $dato['Descripcion1'];?></td>
                    <td><?php echo $dato['PrecioLista'];?></td>
                </tr>
                <?php }?>
            </table>
        </html>
    <?php
    }

    if (isset($_GET['Almacen'])){

        $fecha= date("d/m/Y");
        $Almacen=$_GET['Almacen'];

        $sqlAlm = $pdo->prepare("SELECT Nombre FROM almacen where Almacen=$Almacen");
        $sqlAlm -> execute(array($Almacen));
        $resultadoAlm = $sqlAlm->fetch();
        $NombAlm=$resultadoAlm['Nombre'];

        header('Content-type:application/xls');
        header("Content-Disposition:attachment; filename= Articulos_$NombAlm _$fecha.xls");
        
        $sqla= $pdo->prepare("SELECT * FROM articulo WHERE Almacen='$Almacen' ORDER BY Articulo ASC");
        $sqla->execute();
        $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

        <html>
            <table border="1">
                <tr>
                    <th>Articulo</th>
                    <th>Descripción</th>
                    <th>Precio Lista</th>
                </tr>
                <?php foreach ($resultadoalm as $datoalm) {?>

                <tr>
                    <td><?php echo $datoalm['Articulo'];?></td>
                    <td><?php echo $datoalm['Descripcion1'];?></td>
                    <td><?php echo $datoalm['PrecioLista'];?></td>
                </tr>
                <?php }?>
            </table>
        </html>
    <?php
    }
?>