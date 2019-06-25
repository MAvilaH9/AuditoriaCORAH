<?php
    session_start();
    include "Conexion.php";
    if (isset($_POST['Sucursal'] )) {
        $sucursal=$_POST['Sucursal'];
        $sql= $pdo->prepare("SELECT * FROM articulo WHERE Sucursal='$sucursal' ORDER BY Articulo ASC");
        $sql->execute();
        $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
    ?>
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright" align="right">

                <a href="../Recursos/ExcVentas.php?Sucursal=<?php echo $sucursal;?>" class="btn btn-default align:center" title="Exportar excel"><i
                        class="glyphicon glyphicon-export icon-share"></i></a>

                <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th>Articulo</th>
                            <th>Descripción</th>
                            <th>Precio Lista</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($resultado as $dato) {?>
                        <tr>
                            <td><?php echo $dato['Articulo']; ?></td>
                            <td><?php echo $dato['Descripcion1']; ?></td>
                            <td><?php echo $dato['PrecioLista']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table> <br>
                <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                    data-target="#CancelarVentaSuc">
                    <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                    Cancelar
                </button>
            </div>
        </div>
    </div>

<?php 
}

if (isset($_POST['Almacen'])) {
    $Almacen=$_POST['Almacen'];
    $sqla= $pdo->prepare("SELECT * FROM articulo WHERE Almacen='$Almacen' ORDER BY Articulo ASC");
    $sqla->execute();
    $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC);
    ?>

    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright" align="right">

                <a href="../Recursos/ExcVentas.php?Almacen=<?php echo $Almacen;?>" class="btn btn-default align:center" title="Exportar excel"><i
                        class="glyphicon glyphicon-export icon-share"></i></a>

                <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th>Articulo</th>
                            <th>Descripción</th>
                            <th>Precio Lista</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($resultadoalm as $datoalm) {?>
                        <tr>
                            <td><?php echo $datoalm['Articulo']; ?></td>
                            <td><?php echo $datoalm['Descripcion1']; ?></td>
                            <td><?php echo $datoalm['PrecioLista']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table> <br>
                <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                    data-target="#CancelarVentaAlm">
                    <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                    Cancelar
                </button>
            </div>
        </div>
    </div>

<?php
}
?>



<!-- data table JS
	============================================ -->
<script src="../js/tablas.js"></script>