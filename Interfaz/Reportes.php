<?php include "Templete/Header.php"; ?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1>Archivos <span class="table-project-n">de</span> Reportes</h1>
                        </div> <br>

                        <div id="Lista" class="datatable-dashv1-list custom-datatable-overright">

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

<script>
    function MostrarArchivos() {
        $('#Lista').load('Lista_Archivos.php');
    }
</script>

<script type="text/javascript" language="javascript">

    $(document).ready(function() {

        MostrarArchivos();
        // Eliminar
        $(document).on("click", "#Eliminar", function() {
            var id = $(this).data("id");
            alert(id);
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
                        url: "Descarga.php",
                        data: {
                            id: id,
                        },
                        success: function(resp) {
                            if (resp == 1) {
                                MostrarArchivos();
                                Swal.fire(
                                    'Eliminado!',
                                    'El archivo ha sido eliminado.',
                                    'success'
                                )
                            } else {
                                MostrarArchivos();
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