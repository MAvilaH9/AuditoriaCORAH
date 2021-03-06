<?php 
    include "Templete/Header.php"; 
    $año=$_GET['Año'];
    $Empresa=$_SESSION['NombreEmpresa'];
?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1>Archivos <span class="table-project-n">de</span> Reportes</h1>
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Archivos de Reportes</span>
                                </li>
                            </ul>
                        </div> <br>

                        <div id="Lista" class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th>Descargar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $directorio = opendir('../Reportes/'.$Empresa.'/'.$año); //ruta actual
                                    while ($archivo = readdir($directorio)){ //obtenemos un archivo y luego otro sucesivamente
                                        if ($archivo != "." && $archivo !="..") { ?>
                                        <tr>
                                            <td> <i class="fa fa-file-excel-o text-success"></i> &nbsp;<?php echo $archivo ?></td>
                                            <td>
                                                <a title="Descargar" class="pd-setting-ed external" href="Descarga_Reportes.php?Archivo=<?php echo $archivo; ?>&Año=<?php echo $año; ?>">
                                                    <i class="fa fa-cloud-download edu-check-icon" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button id="Eliminar" data-id="<?php echo $archivo; ?>" data-anio="<?php echo $año; ?>" title="Eliminar" class="pd-setting-ed"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php 
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

<!-- <iframe src="//docs.google.com/gview?url=http://www.snee.com/xml/xslt/sample.doc&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe> -->

    <!-- Static Table End -->

<?php include "Templete/Footer.php"; ?>


<script type="text/javascript" language="javascript">

    $(document).ready(function() {

        // Eliminar
        $(document).on("click", "#Eliminar", function() {
            var id = $(this).data("id");
            var anio = $(this).data("anio");

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Será eliminado el archivo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "Descarga_Reportes.php",
                        data: {
                            anio: anio,
                            id: id,
                        },
                        success: function(resp) {
                            if (resp == 1) {
                            
                                Swal.fire(
                                    'Eliminado!',
                                    'El archivo ha sido eliminado.',
                                    'success',
                                )
                                setTimeout("location.reload()", 2000);
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'No se pudo eliminar!',
                                })
                            }
                        }
                    });
                }
            })
        });

    });

</script>

<script>

    $(document).ready(function () {
        
        $("a.external").click(function() {
            url = $(this).attr("href");
            window.open(url, '_blank');
            return false;
        });
        $("a.external").off('click');

    });

</script>