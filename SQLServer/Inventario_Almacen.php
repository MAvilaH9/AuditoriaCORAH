<?php 
    session_start();
    include "Conexion.php";

    if (isset($_POST['Almacen'])) {
        $Almacen=$_POST['Almacen'];
        $Empresa= $_SESSION['Empresa'];
        $sqla= $pdo->prepare("SELECT * from Articulo a 
            inner join Almacen al on a.Almacen=al.Almacen
            inner join Empresa e on e.ClaveEmpresa=al.ClaveEmpresa
            where a.Almacen='$Almacen' and al.ClaveEmpresa='$Empresa'
            ORDER BY Articulo ASC"
        );
        $sqla->execute();
        $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="../SQLServer/ExcInventario.php?Almacen=<?php echo $Almacen;?>" class="btn btn-default align:center" title="Exportar excel"><i
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
                    data-target="#CancelarInventarioaAlm">
                    <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                    Cancelar
                </button>
            </div>
        </div>
    </div>

<?php } else { ?>
    
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
                <a class="btn btn-custon-two btn-primary" href="../Interfaz/Inventario_Almacen.php">
                    <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                    Regresar 
                </a>
            </div>
        </div>
    </div>
<?php } ?>

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
