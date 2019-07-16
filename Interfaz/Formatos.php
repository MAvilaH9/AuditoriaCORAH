<?php include "Templete/Header.php"; ?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1> <span class="table-project-n"></span>Formatos</h1>
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Formatos</span>
                                </li>
                            </ul>
                        </div>
                        <?php
                        if ($_SESSION['Perfil']==1) { ?>
                        <!-- Boton agragar -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-custon-rounded-two btn-primary" data-toggle="modal"
                                id="btn_agregar" data-target="#ModalFormato">Agregar &nbsp;&nbsp;
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <?php
                        }
                        ?>
                        <br><br> 
                        <!-- Alertas  -->
                        <div class="row">
                            <div class="col-lg-3 col-md-13 col-sm-13 col-xs-12">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div id="AlertExito" class="alert alert-success" role="alert" style="display:none">
                                    <strong>Exitoso!</strong> Archivo guardado con exito
                                </div>
                                <div id="AlertError" class="alert alert-danger alert-mg-b" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Error!</strong> Archivo no guardado.
                                </div>
                                <div id="AlertArcExistente" class="alert alert-danger alert-mg-b" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Advertencia!</strong> Archivo ya existe.
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-13 col-sm-3 col-xs-12">
                            </div>
                        </div>

                        <div id="Lista" class="datatable-dashv1-list custom-datatable-overright">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>

<!-- Modal Auditor -->

<div id="ModalFormato" class="modal modal-edu-general default-popup-PrimaryModal fade modal fade bd-example-modal-lg"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1" style="text-align:center;">
                <h4 class="modal-title">Agregar Formato</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                        <form id="frmFormato">
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="file-upload-inner ts-forms">
                                            <div class="input prepend-big-btn">
                                                <label class="icon-right" for="prepend-big-btn">
                                                    <i class="fa fa-download"></i>
                                                </label>
                                                <div class="file-button">
                                                    Agregar
                                                    <input type="file" name="Archivo" required
                                                        onchange="document.getElementById('prepend-big-btn').value = this.value;"
                                                        accept=".xlsx">
                                                </div>
                                                <input type="text" id="prepend-big-btn"
                                                    placeholder="No se ha seleccionado ningun archivo">
                                            </div>
                                        </div>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" name="action" id="action" value="Add"
                                            class="btn btn-custon-rounded-two btn-success">
                                            <i class="fa fa-save" aria-hidden="true"></i>
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-custon-rounded-two btn-danger"
                                            data-dismiss="modal">
                                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <iframe src="//docs.google.com/gview?url=http://www.snee.com/xml/xslt/sample.doc&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe> -->

<!-- Static Table End -->

<?php include "Templete/Footer.php"; ?>

<script>
    function MostrarArchivos() {
        $('#Lista').load('Lista_Formatos.php');
    }
</script>

<script type="text/javascript" language="javascript">
    $(document).ready(function () {

        MostrarArchivos();

        // Agregar
        $(document).on('submit', '#frmFormato', function (event) {
            event.preventDefault();
            var datos = $('#frmFormato').serialize();
            // alert(datos);
            $.ajax({
                url: "../SQLServer/Formatos.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    // alert(data);
                    $('#frmFormato')[0].reset();
                    if (data == 1) {
                        $("#ModalFormato").modal("hide");
                        MostrarArchivos();
                        $("#AlertExito").fadeIn();
                        setTimeout(function () {
                            $("#AlertExito").fadeOut();
                        }, 2000);
                        $("#tabla").html(data);
                    } else if (data == 2) {
                        $("#ModalFormato").modal("hide");
                        MostrarArchivos();
                        $("#AlertError").fadeIn();
                        setTimeout(function () {
                            $("#AlertError").fadeOut();
                        }, 2000);
                    } else {
                        $("#ModalFormato").modal("hide");
                        MostrarArchivos();
                        $("#AlertArcExistente").fadeIn();
                        setTimeout(function () {
                            $("#AlertArcExistente").fadeOut();
                        }, 2000);
                    }
                }
            });
        });

        // Eliminar
        $(document).on("click", "#Eliminar", function () {
            var id = $(this).data("id");
            // alert(id);
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
                        url: "Descarga_Formatos.php",
                        data: {
                            id: id,
                        },
                        success: function (resp) {
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

        $("a.external").click(function () {
            url = $(this).attr("href");
            window.open(url, '_blank');
            return false;
        });
        $("a.external").off('click');

    });
</script>