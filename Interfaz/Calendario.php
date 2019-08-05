<?php 
    include "Templete/Header.php"; 
?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1>Lista <span class="table-project-n">de</span> Sucursales a auditar</h1>
                        </div>
                    </div>

                    <div class="sparkline13-graph">
                        <!-- Boton agragar -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        </div>
                        <!-- EStado de navegaccion -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Sucursales a auditar</span>
                                </li>
                            </ul>
                        </div> <br>
                        <!-- Muesta la lista -->
                        <div id="tabla_AlmAuditar" class="datatable-dashv1-list custom-datatable-overright">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<!-- Static Table End -->

<?php include "Templete/Footer.php"; ?>

<script>
    function MostrarDatos() {
        $('#tabla_AlmAuditar').load('../SQLServer/Auditor_AlmAuditar.php');
    }
</script>

<script>
    $(document).ready(function () {
        MostrarDatos();
    });
</script>


