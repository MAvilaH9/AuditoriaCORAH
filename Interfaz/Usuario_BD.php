<?php 
    include "Templete/Header.php"; 
    require_once ("../SQLServer/Conexion.php");
?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1>Lista <span class="table-project-n">de</span> Usuarios de Base de Datos</h1>
                        </div>
                    </div>
                    <!-- Alertas  -->
                    <div id="AlertExito" class="alert alert-success" role="alert" style="display:none">
                        <strong>Exitoso!</strong> Datos guardados con exito
                    </div>
                    <div id="AlertError" class="alert alert-danger alert-mg-b" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Error!</strong> Al agregar los datos en la base de datos.
                    </div>
                    <div id="AlertUsuario" class="alert alert-danger alert-mg-b" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Advertencia!</strong>ya existe en la base de datos.
                    </div>

                    <div class="sparkline13-graph">
                        <!-- Boton agragar -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-custon-rounded-two btn-primary" data-toggle="modal"
                                id="btn_agregar" data-target="#ModalUsuario">Agregar &nbsp;&nbsp; 
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Usuario Base de Datos</span>
                                </li>
                            </ul>
                        </div> <br>

                        <!-- Muesta la lista -->
                        <div id="tabla_Usuario" class="datatable-dashv1-list custom-datatable-overright">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<!-- Static Table End -->


<!-- Modal Auditor -->

<div id="ModalUsuario" class="modal modal-edu-general default-popup-PrimaryModal fade modal fade bd-example-modal-lg"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Registrar nuevo usuario de base de datos</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                        <form id="frmUsuarioBD" class="dropzone dropzone-custom needsclick add-professors">
                            <div class="row">
                                <!-- Nombre de la empresa  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Usuario</label>
                                        <input name="UsuarioBD" id="UsuarioBD" type="text" class="form-control"
                                            placeholder="Nombre del usuario" required />
                                    </div>
                                </div>

                                <!-- nombre de la base de datos -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Contraseña</label>
                                        <input name="Contrasenia" id="Contrasenia" type="text" class="form-control"
                                            placeholder="Nombre de la base de datos" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                                </div>

                                <!-- Descripcion -->
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Descripción</label>
                                        <input name="Descripcion" id="Descripcion" type="text" class="form-control"
                                            placeholder="Descripción del usuario" required />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                                </div>
                            </div>
                            <br> <br>
                            <input type="hidden" name="IdUsuarioBD" id="IdUsuarioBD" />
                            <input type="hidden" name="operation" id="operation" />
                            <button id="Cancelar" type="button" class="btn btn-custon-rounded-two btn-danger" data-dismiss="modal">
                                <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                Cancelar
                            </button>
                            <!-- <a data-dismiss="modal" href="#">Cancel</a> -->
                            <button type="submit" name="action" id="action" value="Add"
                                class="btn btn-custon-rounded-two btn-success">
                                <i class="fa fa-save edu-checked-pro" aria-hidden="true"></i>
                                Guardar
                            </button>
                        </form>
                    </div> <br>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "Templete/Footer.php"; ?>

<script type="text/javascript" language="javascript">
    function MostrarDatos() {
        $('#tabla_Usuario').load('../SQLServer/Tabla_UsuarioBD.php');
    }
</script>

<script type="text/javascript" language="javascript">

    $(document).ready(function () {
        MostrarDatos();


        // Modal Agregar
        $('#btn_agregar').click(function () {
            $('#frmUsuarioBD')[0].reset();
            $('.modal-title').text("Agregar Nuevo Auditor");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        // Boton Cancelar
        $('#Cancelar').click(function () {
            location.reload();
        });

        // Agregar
        $(document).on('submit', '#frmUsuarioBD', function (event) {
            event.preventDefault();
            var datos = $('#frmUsuarioBD').serialize();
            // alert(datos);
            $.ajax({
                url: "../SQLServer/Usuario_BD.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    // alert(data);
                    $('#frmUsuarioBD')[0].reset();
                    if (data == 1) {
                        // alert(dato);
                        MostrarDatos();
                        $("#AlertExito").fadeIn();
                        setTimeout(function () {
                            $("#AlertExito").fadeOut();
                        }, 2000);
                        $("#ModalUsuario").modal("hide");
                    } else if (data == 2) {
                        MostrarDatos();
                        $("#ModalUsuario").modal("hide");
                        $("#AlertError").fadeIn();
                        setTimeout(function () {
                            $("#AlertError").fadeOut();
                        }, 2000);
                    } else {
                        $("#AlertUsuario").fadeIn();
                        $("#ModalUsuario").modal("hide");
                        setTimeout(function () {
                            $("#AlertUsuario").fadeOut();
                        }, 2000);
                    }
                }
            });
        });

        // Actualizar
        $(document).on("click", "#Editar", function () {
            var IdUsuarioBD = $(this).data("id");
            // alert(IdUsuarioBD);
            $.ajax({
                url: "../SQLServer/Datos_UsuarioBD.php",
                method: "POST",
                data: {
                    IdUsuarioBD: IdUsuarioBD
                },
                dataType: "json",
                success: function (data) {
                    // alert(data);
                    $('#ModalUsuario').modal('show');
                    $('#UsuarioBD').val(data.Usuario);
                    $('#Contrasenia').val(data.Contrasena);
                    $('#Descripcion').val(data.Descripcion);
                    $('.modal-title').text("Actualizar datos");
                    $('#IdUsuarioBD').val(IdUsuarioBD);
                    $('#action').val("Edit");
                    $('#action').text("Actualizar");
                    $('#operation').val("Edit");
                    // var cla = data.ClaveEmpresa;
                }
            })
        });

        // Eliminar
        $(document).on("click", "#Eliminar", function () {
            var id = $(this).data("id");
            //  alert(id);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Será eliminado de la base de datos!",
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
                        url: "../SQLServer/Eliminar_UsuarioBD.php",
                        data: {
                            id: id,
                        },
                        success: function (resp) {
                            if (resp == 1) {
                                MostrarDatos();
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                )
                            } else {
                                MostrarDatos();
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

