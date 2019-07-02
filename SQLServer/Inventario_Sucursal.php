<?php 
    session_start();
    include "Conexion.php";

    if (isset($_POST['Sucursal'] )) {
        $sucursal=$_POST['Sucursal'];
        $empresa= $_SESSION['Empresa'];
        $sql= $pdo->prepare("SELECT * from Articulo a 
            inner join Sucursal s on a.Sucursal=s.Sucursal
            inner join Empresa e on e.ClaveEmpresa=s.ClaveEmpresa
            where s.Sucursal=$sucursal and s.ClaveEmpresa='$empresa'
            ORDER BY Articulo ASC"
        );
        $sql->execute();
        $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
    ?>
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd" style="text-align: center">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright" align="right">

                <a class="btn btn-default align:center external" href="../SQLServer/ExcInventario.php?Sucursal=<?php echo $sucursal;?>" title="Descargar excel">
                    <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                    <i class="fa fa-cloud-download edu-check-icon"></i>
                </a>

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
                <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Inventario_Sucursal.php">
                    <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                    Regresar 
                </a>
                <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                    data-target="#CancelarInventarioaSuc">
                    <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                    Cancelar
                </button> -->
            </div>
        </div>
    </div>

    <?php 
    } else { ?>
    
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
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
                    </tbody>
                </table> <br>
                <a class="btn btn-custon-two btn-primary external" href="../Interfaz/Inventario_Sucursal.php">
                    <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                    Regresar 
                </a>
            </div>
        </div>
    </div>
    <?php 
    } ?>

    <!-- data table JS
	============================================ -->
    <script src="../js/tablas.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $("a.external").click(function() {
                url = $(this).attr("href");
                window.open(url,'_blank');
                return false;
            });
            
            $("a.external").off('click');
        });
    </script>