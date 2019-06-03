<?php include "Templete/Header.php"; ?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Lista <span class="table-project-n">de</span> Auditores</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <a class="btn btn-custon-rounded-two btn-primary" href="#" data-toggle="modal"
                            data-target="#AgregarAuditor"><i class="fa fa-plus" aria-hidden="true"></i>
                            Agregar Nuevo
                        </a>
                        <div id="tabla_auditor" class="datatable-dashv1-list custom-datatable-overright">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<!-- Static Table End -->


<!-- Modal Cancelar -->

<div id="CancelarConsulta" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                <h2>Cancelar!</h2>
                <p>¿Está seguro que desea cancelar el proceso?</p>
            </div>
            <div class="modal-footer danger-md">
                <a data-dismiss="modal" href="#">Cancelar</a>
                <a href="Index.php">Aceptar</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar -->

<div id="AgregarAuditor" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Registrar nuevo auditor</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                        <form id="frmauditor" class="dropzone dropzone-custom needsclick add-professors">
                            <div class="row">
                                <!-- Apellido Paterno -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Apellido Paterno</label>
                                        <input name="ApellidoPat" id="ApellidoPat" type="text" class="form-control"
                                            placeholder="Apellido Paterno" required />
                                    </div>
                                </div>

                                <!-- Apellido Materno -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Apellido Materno</label>
                                        <input name="ApellidoMat" id="ApellidoMat" type="text" class="form-control"
                                            placeholder="Apellido Materno" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Nombres -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Nombre (s)</label>
                                        <input name="Nombre" id="Nombre" type="text" class="form-control"
                                            placeholder="Nombre (s)" required />
                                    </div>
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
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Contraseña</label>
                                        <input name="Contrasenia" id="Contrasenia" type="text" class="form-control"
                                            placeholder="Contraseña" required />
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <!-- Select Perfil -->
                                <?php 
                                    include_once ("../Recursos/Conexion.php");
                                    $sql= $pdo->prepare("SELECT IdPerfil, Perfil FROM perfil ORDER BY IdPerfil");
                                    $sql->execute();
                                    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Perfil</label>
                                        <select name="Perfil" id="Pefil" class="form-control">
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
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">Empresa</label>
                                        <select name="Empresa" id="Empresa" class="form-control">
                                            <?php
                                            foreach ($resultado as $dato) { ?>
                                            <option value="<?php echo $dato['ClaveEmpresa']; ?>">
                                                <?php echo $dato['Nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="btn btn-custon-rounded-two btn-danger" data-dismiss="modal">
                                <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                Cancelar
                            </button>
                            <!-- <a data-dismiss="modal" href="#">Cancel</a> -->
                            <button type="submit" id="agregar" class="btn btn-custon-rounded-two btn-success">
                                <i class="fa fa-check edu-checked-pro" aria-hidden="true"></i>
                                Agregar
                            </button>
                        </form>
                    </div> <br>
                    <!-- Alertas  -->
                    <div id="AlertExito" class="alert alert-success" role="alert" style="display:none">
                        <strong>Exitoso!</strong> Auditor agrregado con exito
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->

<div id="EditarAuditor" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Registrar nuevo auditor</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="edit" class="pro-ad">
                    <button type="submit" id="Actualizar" class="btn btn-custon-rounded-two btn-success">
            <i class="fa fa-check edu-checked-pro" aria-hidden="true"></i>
            Actualizar
        </button>
                    </div> <br>
                    <!-- Alertas  -->
                    <div id="AlertExito" class="alert alert-success" role="alert" style="display:none">
                        <strong>Exitoso!</strong> Auditor agrregado con exito
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
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        // Mostrar tabla
        function mostrar_datos() {
            $.ajax({
                url: "../Recursos/Tabla_Auditor.php",
                type: "Post",
                success: function (data) {
                    $("#tabla_auditor").html(data);
                }
            });
        }
        // Funcion mostrar que se ejecuta
        mostrar_datos();

        // Funcion Agregar
        $('#frmauditor').submit(function (e) {
            // e.preventDefault();
            var datos = $('#frmauditor').serialize();
            $.ajax({
                type: "POST",
                url: "../Recursos/AltaAuditor.php",
                data: datos,
                success: function (r) {
                    if (r == 1) {
                        $("#AlertExito").fadeIn(r);
                        setTimeout(function () {
                            $("#AlertExito").fadeOut(r);
                        }, 2000);
                        Limpiar();
                        mostrar_datos(r);
                    } else if (r == 2) {
                        $("#AlertError").delay(500).fadeIn("slow");
                        setTimeout(function () {
                            $("#AlertError").fadeOut(r);
                        }, 2000);
                        Limpiar();
                    } else {
                        $("#AlertUsuario").delay(500).fadeIn("slow");
                        setTimeout(function () {
                            $("#AlertUsuario").fadeOut(r);
                        }, 2000);
                        Limpiar();
                    }
                }
            });
            return false;
        });

        // Eliminar
        $(document).on("click", "#Eliminar", function () {
            var id = $(this).data("id");
            // alert(id);
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
                        url: "../Recursos/Eliminar_Auditor.php",
                        data: {
                            id: id,
                        },
                        success: function (resp) {
                            if (resp == 1) {
                                mostrar_datos();
                            } else {
                                alert("No eliminado");
                            }
                        }
                    });
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado.',
                        'success'
                    )
                }
            })
        });

        // Limpiar Campoas
        function Limpiar() {
            $(':text').each(function () {
                $($(this).val(''));
            });
        }

        // Mostrar modal
        $(document).on("click", "#Editar", function () {
            var idu = $(this).data("id");
            // alert(id);
            $.ajax({
                type: "POST",
                url: "../Recursos/Actualizar_Auditor.php",
                data: {
                    id: idu,
                },
                success: function (datos) {
                    $("#edit").html(datos);
                }
            });
            $('#EditarAuditor').modal('show');

        });

        // Envio de datos para actualizar
        $('#editarusuario').submit(function () {
            var parametros = $('#editarusuario').serialize();
            $.ajax({
                type: "POST",
                url: "../Recursos/Actualizar.php",
                data: parametros,
                success: function (re) {
                    if (re == 1) {
                        alertify.success("Actualizado con exito :)");
                        // $("#AlertExito").fadeIn(re);
                        // setTimeout(function () {
                        //     $("#AlertExito").fadeOut(r);
                        // }, 2000);
                        // Limpiar();
                        // mostrar_datos(re);
                    } else if (re == 2) {
                        alert("No");
                        // $("#AlertError").delay(500).fadeIn("slow");
                        // setTimeout(function () {
                        //     $("#AlertError").fadeOut(re);
                        // }, 2000);
                        // Limpiar();
                    } else {
                        // $("#AlertUsuario").delay(500).fadeIn("slow");
                        // setTimeout(function () {
                        //     $("#AlertUsuario").fadeOut(re);
                        // }, 2000);
                        // Limpiar();
                    }
                }
            });
            return false;
        });
    });
</script>

<?php include "Templete/Footer.php"; ?>