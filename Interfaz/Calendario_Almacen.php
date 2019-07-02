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
                            <h1>Lista <span class="table-project-n">de</span> Almacenes a auditar</h1>
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
                        <!-- Boton agragar -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-custon-rounded-two btn-primary" data-toggle="modal"
                                id="btn_agregar" data-target="#ModalAlmAuditar">Agregar &nbsp;&nbsp; <i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </div>
                        <!-- EStado de navegaccion -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Almacenes a auditar</span>
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


<!-- Modal Auditor -->

<div id="ModalAlmAuditar" class="modal modal-edu-general default-popup-PrimaryModal fade modal fade bd-example-modal-lg"
    role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Registrar sucursal a auditar</h4>
                <!-- <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                        <form id="frmAlmAuditar" class="dropzone dropzone-custom needsclick add-professors">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                </div>
                                <!-- Select Empresa -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <?php 
                                        $sqle= $pdo->prepare("SELECT ClaveEmpresa, Nombre FROM empresa ORDER BY Nombre");
                                        $sqle->execute();
                                        $resultadoe=$sqle->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Empresa</label>
                                        <select name="Empresa" id="Empresa" class="form-control">
                                            <option selected disabled>Seleccione...</option>
                                            <?php
                                            foreach ($resultadoe as $datoe) { ?>
                                            <option value="<?php echo $datoe['ClaveEmpresa']; ?>">
                                                <?php echo $datoe['Nombre']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Almacen -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <?php 
                                        $sqle= $pdo->prepare("SELECT Almacen, Nombre as NomAlmacen FROM Almacen ORDER BY Nombre");
                                        $sqle->execute();
                                        $resultadoe=$sqle->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Almacen</label>
                                        <select name="Almacen" id="Almacen" class="form-control">
                                            <option selected disabled>Seleccione...</option>
                                            <?php
                                            foreach ($resultadoe as $datoe) { ?>
                                            <option value="<?php echo $datoe['Almacen']; ?>">
                                                <?php echo $datoe['NomAlmacen']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                </div>
                                <!-- Select Usuario -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <?php 
                                        $sqlus= $pdo->prepare("SELECT IdUsuario, CONCAT(ApellidoPaterno, ' ', ApellidoMaterno, ' ', Nombres) AS Auditor FROM usuario");
                                        $sqlus->execute();
                                        $resultadous=$sqlus->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Auditor</label>
                                        <select name="Auditor" id="Auditor" class="form-control">
                                            <option selected disabled >Seleccione...</option>
                                            <?php
                                            foreach ($resultadous as $datous) { ?>
                                            <option value="<?php echo $datous['IdUsuario']; ?>">
                                                <?php echo $datous['Auditor']?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Fecha -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="form-group data-custon-pick" id="data_2">
                                    <label class="login2">Fecha a auditar</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" name="Fecha" id="Fecha" class="form-control" value="<?php echo date("d/m/Y"); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="IdAuditar" id="IdAuditar" />
                            <input type="hidden" name="operation" id="operation" />
                            <button type="button" class="btn btn-custon-rounded-two btn-danger" data-dismiss="modal">
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

<script>
    function MostrarDatos() {
        $('#tabla_AlmAuditar').load('../SQLServer/tabla_AlmAuditar.php');
    }
</script>

<!-- Combos dinamicos -->
<script>

    // Almacenes
    $(document).ready(function () {
        $("#Empresa").change(function () { 
            // e.preventDefault();

            $("#Empresa option:selected").each(function () {
                ClaveEmpresa = $(this).val();
                $.post("../SQLServer/Almacenes.php",{ ClaveEmpresa: ClaveEmpresa},
                function(data){
                    $("#Almacen").html(data);
                });            
            });
        });
    });

    // Sucursales
    $(document).ready(function () {
        $("#Empresa").change(function () { 
            // e.preventDefault();

            $("#Empresa option:selected").each(function () {
                ClaveEmpresa = $(this).val();
                $.post("../SQLServer/Sucursales.php",{ ClaveEmpresa: ClaveEmpresa},
                function(data){
                    $("#Sucursal").html(data);
                });            
            });
        });
    });

    // Auditores
    $(document).ready(function () {
        $("#Empresa").change(function () {

            $("#Empresa option:selected").each(function () {
                ClaveEmpresa = $(this).val();
                $.post("../SQLServer/Auditores.php",{ ClaveEmpresa: ClaveEmpresa},
                function(data) {
                    $("#Auditor").html(data);
                });

            });

        });
    });

</script>

<!-- ABC -->
<script type="text/javascript" language="javascript">

    $(document).ready(function () {

        MostrarDatos();
        // Modal Agregar
        $('#btn_agregar').click(function () {
            $('#frmAlmAuditar')[0].reset();
            $('.modal-title').text("Sucursal a auditar");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        // Agregar y actualizar
        $(document).on('submit', '#frmAlmAuditar', function (event) {
            event.preventDefault();
            var datos = $('#frmAlmAuditar').serialize();
            // alert(datos);
            $.ajax({
                url: "../SQLServer/Calendario.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    // alert(data);
                    $('#frmAlmAuditar')[0].reset();
                    if (data == 1) {
                        // alert(dato);
                        $("#ModalAlmAuditar").modal("hide");
                        MostrarDatos();
                        $("#AlertExito").fadeIn();
                        setTimeout(function () {
                            $("#AlertExito").fadeOut();
                        }, 2000);
                    } else if (data == 2) {
                        $("#ModalAlmAuditar").modal("hide");
                        MostrarDatos();
                        $("#AlertError").fadeIn();
                        setTimeout(function () {
                            $("#AlertError").fadeOut();
                        }, 2000);
                    }
                }
            });
        });

        // Actualizar
        $(document).on("click", "#Editar", function () {
            var IdAuditar = $(this).data("id");
            // alert(IdAuditar);
            $.ajax({
                url: "../SQLServer/Datos_AlmAuditar.php",
                method: "POST",
                data: {
                    IdAuditar: IdAuditar
                },
                dataType: "json",
                success: function (data) {
                    // alert(data);
                    $('#ModalAlmAuditar').modal('show');
                    $('#IdAuditar').val(data.IdAuditar);
                    $('#Empresa').val(data.ClaveEmpresa);
                    $('#Almacen').val(data.Almacen);
                    $('#Auditor').val(data.IdUsuario);
                    $('#Fecha').val(data.Fecha);
                    $('.modal-title').text("Actualizar datos");
                    $('#action').val("Edit");
                    $('#action').text("Actualizar");
                    $('#operation').val("Edit");
                    // var cla = data.ClaveEmpresa;
                }
            })
        });

        // Eliminar
        $(document).on("click", "#Eliminar", function () {
            var IdAuditar = $(this).data("id");
            //  alert(IdAuditar);
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
                        url: "../SQLServer/Eliminar_SucAuditar.php",
                        data: {
                            IdAuditar: IdAuditar,
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

