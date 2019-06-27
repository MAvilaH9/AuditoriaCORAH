<?php include "Templete/Header.php"; ?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Archivos <span class="table-project-n">de</span> Reportes</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">                                                
                            <!-- <a href="../Recursos/pdf.php" class="btn btn-default align:center" title="Exportar excel"><i class="glyphicon glyphicon-export icon-share"></i></a> -->
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true" data-cookie-id-table="saveId"  data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th>Descargar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $directorio = opendir("../Excel/"); //ruta actual
                                        while ($archivo = readdir($directorio)){ //obtenemos un archivo y luego otro sucesivamente
                                            if ($archivo != "." && $archivo !="..") {?>
                                                <tr>
                                                    <td> <i class="fa fa-file-excel-o text-success"></i> &nbsp;<?php echo $archivo ?></td>
                                                    <td>
                                                        <a title="Descargar" class="pd-setting-ed external" href="Descarga.php?Archivo=<?php echo $archivo; ?>"> 
                                                            <i class="fa fa-cloud-download edu-check-icon" aria-hidden="true"></i>
                                                        </a> 
                                                    </td>      
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                </tbody>
                            </table> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<!-- Static Table End -->

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

<?php include "Templete/Footer.php"; ?>

