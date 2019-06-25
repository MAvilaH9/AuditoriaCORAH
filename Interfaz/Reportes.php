<?php include "Templete/Header.php"; ?>
<?php 
$list= null;
// $directorio = opendir("../ClasesExcel/PHPExcel");

// while ($elemento = readdir($directorio)) {
//     if ($elemento != "." && $elemento!="..") {
//         if (is_dir("../Interfaz/".$elemento)) {
//             $list .= "<li><a href='../Excel/$elemento target='_blank'>$elemento</a></li>";
//         }
//         else{
//             $list .= "<li><a href='../Excel/$elemento target='_blank'>$elemento</a></li>";
//         }
//         $list=$elemento;
//     }
// }
// echo $list;
?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Projects <span class="table-project-n">Data</span> Table</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright" align=right>                                                
   
                            <!-- <a href="../Recursos/pdf.php" class="btn btn-default align:center" title="Exportar excel"><i class="glyphicon glyphicon-export icon-share"></i></a> -->

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true" data-cookie-id-table="saveId"  data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th>Articulo</th>
                                        <th>Descargar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $directorio = opendir("../Excel/"); //ruta actual
                                        while ($archivo = readdir($directorio)){ //obtenemos un archivo y luego otro sucesivamente
                                            if ($archivo != "." && $archivo !="..") {
                                                if (is_dir($archivo)){ ?>
                                                <tr>
                                                    <td><?php echo $archivo ?></td>
                                                    <td>
                                                        <a title="Descargar" class="pd-setting-ed" id="Editar" name="editar" href="Desccarga.php?Archivo="<?php echo $archivo;?>> 
                                                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                                        </a> 
                                                    </td>      
                                                </tr>

                                            <?php } else { ?>
                                                <tr>
                                                    <td><?php echo $archivo ?></td>
                                                    <td>
                                                        <a title="Descargar" class="pd-setting-ed" href="Descarga.php?Archivo=<?php echo $archivo; ?>"> 
                                                            <i class="fa fa-cloud-download edu-check-icon" aria-hidden="true"></i>
                                                        </a> 
                                                    </td>                                              
                                                </tr>
                                                <?php }
                                            }
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

<?php include "Templete/Footer.php"; ?>
