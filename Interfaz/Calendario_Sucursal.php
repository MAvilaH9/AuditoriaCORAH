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
                            <h1>Lista <span class="table-project-n">de</span> Sucursales a auditar</h1>
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
                                id="btn_agregar" data-target="#ModalSucAuditar">Agregar &nbsp;&nbsp; <i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </div>
                        <!-- Estado -->
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
                        <div id="tabla_sucAuditar" class="datatable-dashv1-list custom-datatable-overright">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<!-- Static Table End -->


<!-- Modal Auditor -->

<div id="ModalSucAuditar" class="modal modal-edu-general default-popup-PrimaryModal fade modal fade bd-example-modal-lg"
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
                        <form id="frmSucAuditar" class="dropzone dropzone-custom needsclick add-professors">

                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                </div>
                                <!-- Select Sucursal -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <?php 
                                        $sqls= $pdo->prepare("SELECT Sucursal, Nombre FROM Sucursal ORDER BY Nombre");
                                        $sqls->execute();
                                        $resultados=$sqls->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Sucursal</label>
                                        <select name="Sucursal" id="Sucursal" class="form-control">
                                            <option selected disabled>Seleccione...</option>
                                            <?php
                                            foreach ($resultados as $datos) { ?>
                                            <option value="<?php echo $datos['Sucursal']; ?>">
                                                <?php echo $datos['Nombre']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Almacen -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <?php 
                                        $sqlalm= $pdo->prepare("SELECT Almacen, Nombre FROM Alm ORDER BY Nombre ASC");
                                        $sqlalm->execute();
                                        $resultadoalm=$sqlalm->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Almacen</label>
                                        <select name="Almacen" id="Almacen" class="form-control">
                                            <option selected disabled>Seleccione...</option>
                                            <?php
                                            foreach ($resultadoalm as $datosalm) { ?>
                                            <option value="<?php echo $datosalm['Almacen']; ?>">
                                                <?php echo $datosalm['Nombre']; ?>
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
                                        $sqlus= $pdo->prepare("SELECT Usuario, Nombre FROM Usuario
                                        WHERE GrupoTrabajo='Auditoria'AND Departamento='Auditoria' AND Estatus='ALTA'");
                                        $sqlus->execute();
                                        $resultadous=$sqlus->fetchALL(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label class="login2">Auditor</label>
                                        <select name="Auditor" id="Auditor" class="form-control">
                                            <option selected disabled >Seleccione...</option>
                                            <?php
                                            foreach ($resultadous as $datous) { ?>
                                            <option value="<?php echo $datous['Usuario']; ?>">
                                                <?php echo $datous['Nombre']?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Fecha -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <label class="login2">Fecha a auditar</label>
                                    <div class="form-group data-custon-pick" id="data_2">
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
                            <!-- Instruccion -->
                            <input type="hidden" name="IdAuditar" id="IdAuditar" />
                            <input type="hidden" name="operation" id="operation" />
                            <!-- Botones -->
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
        $('#tabla_sucAuditar').load('../SQLServer/Tabla_SucAuditar.php');
    }
</script>

<!-- Combos dinamicos -->
<script>

    // Almacenes
    $(document).ready(function () {
        $("#Sucursal").change(function () { 
            // e.preventDefault();

            $("#Sucursal option:selected").each(function () {
                Sucursal = $(this).val();
                $.post("../SQLServer/Almacenes.php",{ Sucursal: Sucursal},
                function(data){
                    $("#Almacen").html(data);
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
            $('#frmSucAuditar')[0].reset();
            $('.modal-title').text("Sucursal a auditar");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        // Agregar y actualizar
        $(document).on('submit', '#frmSucAuditar', function (event) {
            event.preventDefault();
            var datos = $('#frmSucAuditar').serialize();
            alert(datos);
            $.ajax({
                url: "../SQLServer/Calendario.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    alert(data);
                    $('#frmSucAuditar')[0].reset();
                    if (data == 1) {
                        // alert(dato);
                        $("#ModalSucAuditar").modal("hide");
                        MostrarDatos();
                        $("#AlertExito").fadeIn();
                        setTimeout(function () {
                            $("#AlertExito").fadeOut();
                        }, 2000);
                    } else if (data == 2) {
                        $("#ModalSucAuditar").modal("hide");
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
                url: "../SQLServer/Datos_SucAuditar.php",
                method: "POST",
                data: {
                    IdAuditar: IdAuditar
                },
                dataType: "json",
                success: function (data) {
                    alert(data);
                    $('#ModalSucAuditar').modal('show');
                    $('#IdAuditar').val(data.IdCalendarioAuditar);
                    $('#Sucursal').val(data.Sucursal);
                    $('#Almacen').val(data.Almacen);
                    $('#Auditor').val(data.Auditor);
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
             alert(IdAuditar);
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

