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
                            <h1>Lista <span class="table-project-n">de</span> Auditores</h1>
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
                        <strong>Advertencia!</strong> Usuario ya existe en la base de datos.
                    </div>
                    <div class="sparkline13-graph">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-custon-rounded-two btn-primary" data-toggle="modal"
                                id="btn_agregar" data-target="#ModalUsuario">Agregar &nbsp;&nbsp; <i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Auditores</span>
                                </li>
                            </ul>
                        </div> <br>
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
                <h4 class="modal-title">Registrar nuevo usuario</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                        <form id="frmUsuario" class="dropzone dropzone-custom needsclick add-professors">
                            <div class="row">
                                <!-- Apellido Paterno -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Apellido Paterno</label>
                                        <input name="ApellidoPat" id="ApellidoPat" type="text" class="form-control"
                                            placeholder="Apellido Paterno" required />
                                    </div>
                                </div>

                                <!-- Apellido Materno -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Apellido Materno</label>
                                        <input name="ApellidoMat" id="ApellidoMat" type="text" class="form-control"
                                            placeholder="Apellido Materno" required />
                                    </div>
                                </div>

                                <!-- Nombres -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Nombre (s)</label>
                                        <input name="Nombre" id="Nombre" type="text" class="form-control"
                                            placeholder="Nombre (s)" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                </div>
                                <!-- Usuario -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Usuario</label>
                                        <input name="Usuario" id="Usuario" type="text" class="form-control"
                                            placeholder="Usuario" required />
                                    </div>
                                </div>

                                <!-- Contraseña -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Contraseña</label>
                                        <input name="Contrasenia" id="Contrasenia" type="text" class="form-control"
                                            placeholder="Contraseña" required />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                </div>
                                <!-- Select Perfil -->
                                <?php 
                                    $sql= $pdo->prepare("SELECT IdPerfil, Perfil FROM perfil ORDER BY IdPerfil");
                                    $sql->execute();
                                    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Perfil</label>
                                        <select name="Perfil" id="Perfil" class="form-control">
                                            <?php
                                            foreach ($resultado as $dato) { ?>
                                            <option value="<?php echo $dato['IdPerfil']; ?>" selected>
                                                <?php echo $dato['Perfil']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Select Empresa -->
                                <?php 
                                    $sql= $pdo->prepare("SELECT ClaveEmpresa, Nombre FROM empresa ORDER BY Nombre");
                                    $sql->execute();
                                    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Empresa</label>
                                        <select name="Empresa" id="Empresa" class="form-control">
                                            <?php
                                            foreach ($resultado as $dato) { ?>
                                            <option value="<?php echo $dato['ClaveEmpresa']; ?>">
                                                <?php echo $dato['Nombre']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="IdUsuario" id="IdUsuario" />
                            <input type="hidden" name="operation" id="operation" />
                            <button type="button" class="btn btn-custon-rounded-two btn-danger" data-dismiss="modal">
                                <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                Cancelar
                            </button>
                            <!-- <a data-dismiss="modal" href="#">Cancel</a> -->
                            <button type="submit" name="action" id="action" value="Add"
                                class="btn btn-custon-rounded-two btn-success">
                                <i class="fa fa-check edu-checked-pro" aria-hidden="true"></i>
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
    $(document).ready(function () {
        MostrarDatos();

        // Modal Agregar
        $('#btn_agregar').click(function () {
            $('#frmUsuario')[0].reset();
            $('.modal-title').text("Agregar Nuevo Auditor");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        // Agregar
        $(document).on('submit', '#frmUsuario', function (event) {
            event.preventDefault();
            var datos = $('#frmUsuario').serialize();
            // alert(datos);
            $.ajax({
                url: "../SQLServer/Usuario.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    // alert(data);
                    $('#frmUsuario')[0].reset();
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
            var idUsuario = $(this).data("id");
            // alert(idUsuario);
            $.ajax({
                url: "../SQLServer/Datos_Usuario.php",
                method: "POST",
                data: {
                    idUsuario: idUsuario
                },
                dataType: "json",
                success: function (data) {
                    //alert(data);
                    $('#ModalUsuario').modal('show');
                    $('#ApellidoPat').val(data.ApellidoPaterno);
                    $('#ApellidoMat').val(data.ApellidoMaterno);
                    $('#Nombre').val(data.Nombres);
                    $('#Usuario').val(data.Usuario);
                    $('#Contrasenia').val(data.Contrasenia);
                    $('#Empresa').val(data.ClaveEmpresa);
                    $('#Perfil').val(data.IdPerfil);
                    $('.modal-title').text("Actualizar datos");
                    $('#IdUsuario').val(idUsuario);
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
                        url: "../SQLServer/Eliminar_Usuario.php",
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

<script>
    function MostrarDatos() {
        $('#tabla_Usuario').load('../SQLServer/Tabla_Usuario.php');
    }
</script>