<?php 
    include_once "Templete/Header.php";
    include_once "../SQLServer/Conexion.php";
?>

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="Titulo" class="product-payment-inner-st">
                    <ul class="breadcome-menu">
                        <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a> <span
                                class="bread-slash">/</span>
                        </li>
                        <li><span class="bread-blod">Ajuste Inventario</span>
                        </li>
                    </ul>
                    <!--  Tìtulo -->
                    <ul id="myTabedu1" class="tab-review-design" style="text-align: center">
                        <li class="active"><a>Ajuste Inventario</a></li> <br> <br> <b></b>

                        <?php 
                            // $RenglonID = 1;
                            // for ($i=1; $i < 3; $i++) { 
                            //     echo $RenglonID = $i." ";
                            //     echo $renglon = 2048 * $i;
                            //     echo "<br>";
                            // }
                       ?>
                    </ul>
                    <!-- Formulario para la Consula  -->
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <form id="frmAjusteInv" action="../SQLServer/Ajustes.php" 
                                                method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <?php 
                                                            // $Empresa=$_SESSION['Empresa'];                                                           
                                                            $sql= $pdo->prepare("SELECT Almacen, Nombre FROM Alm ORDER BY Nombre ASC");
                                                            $sql->execute();
                                                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <!-- Select Movimiento -->
                                                        <div class="form-group">
                                                            <label class="login2">Movimiento</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Movimiento" id="Movimiento"
                                                                    class="chosen-select" tabindex="1">
                                                                    <option value="Ajuste" selected="">
                                                                        Ajuste</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Fecha Emision -->
                                                        <div class="form-group">
                                                            <label class="login2">Fecha Emisión</label>
                                                            <div class="form-group data-custon-pick" id="data_2">
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                                    <input type="text" name="FechaEmision" id="Fecha"
                                                                        class="form-control" tabindex="3"
                                                                        value="<?php echo date("d/m/Y"); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Referencia -->
                                                        <div class="form-group">
                                                            <label class="login2">Referencia</label>
                                                            <input name="Referencia" id="Referencia" type="text"
                                                                tabindex="5" class="form-control"
                                                                placeholder="Ingrese referencia" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <!-- Select Almacen -->
                                                        <div class="form-group">
                                                            <label class="login2">Almacen</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Almacen" id="Almacen"
                                                                    class="chosen-select" tabindex="2">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione
                                                                        Almacen</option>
                                                                    <?php 
                                                                    foreach ($resultado as $dato) {
                                                                        echo '<option value="'.$dato['Almacen'].'">'.$dato['Nombre'].'</option>';
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Concepto -->
                                                        <div class="form-group">
                                                            <label class="login2">Concepto</label>
                                                            <input name="Concepto" id="Concepto" type="text"
                                                                tabindex="4" class="form-control"
                                                                placeholder="Ingrese el concepto" required>
                                                        </div>
                                                        <!-- Observaciones -->
                                                        <div class="form-group">
                                                            <label class="login2">Observaciones</label>
                                                            <input name="Observacion" id="Observacion" type="text"
                                                                tabindex="6" class="form-control"
                                                                placeholder="Ingrese la observación" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                        <input type="hidden" name="operacion" id="operacion" value="Agregar">
                                                    </div>
                                                    <!-- Archivo -->
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" align="center">
                                                        <div class="form-group">
                                                            <label class="login2">Agregar
                                                                Archivo Excel</label>
                                                            <div class="file-upload-inner ts-forms">
                                                                <div class="input prepend-big-btn">
                                                                    <label class="icon-right" for="prepend-big-btn">
                                                                        <i class="fa fa-download"></i>
                                                                    </label>
                                                                    <div class="file-button">
                                                                        Agregar
                                                                        <input type="file" name="excel" id="excel" required
                                                                            onchange="document.getElementById('prepend-big-btn').value = this.value;"
                                                                            accept=".xlsx">
                                                                    </div>
                                                                    <input type="text" id="prepend-big-btn"
                                                                        placeholder="No se ha seleccionado ningun archivo" tabindex="7">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    </div>
                                                </div>
                                                <!-- Botones -->
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="button-ad-wrap">
                                                            <div class="button-ap-list responsive-btn">
                                                                <div class="button-style-two btn-mg-b-10">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <a id="can"
                                                                        class="btn btn-custon-rounded-two btn-danger external"
                                                                        href="Descarga_Reportes.php?Cancelar2=Cancelar2" tabindex="9">
                                                                        <i class="fa fa-times edu-danger-error"
                                                                            aria-hidden="true"></i>
                                                                        Cancelar
                                                                    </a>
                                                                    <button type="button" id="regresar" hidden
                                                                        class="btn btn-custon-rounded-two btn-danger"
                                                                        data-toggle="modal" data-target="#Cancelar" tabindex="11">
                                                                        <i class="fa fa-times edu-danger-error"
                                                                            aria-hidden="true"></i>
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" id="BotonAgregar"
                                                                        class="btn btn-custon-rounded-two btn-success" tabindex="8">
                                                                        <i class="fa fa-plus" aria-hidden="true" ></i>
                                                                        Agregar
                                                                    </button>
                                                                    <button type="submit" id="BotonGuardar" hidden
                                                                        class="btn btn-custon-rounded-two btn-success" tabindex="10">
                                                                        <i class="fa fa-save" aria-hidden="true"></i>
                                                                        Guardar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Alertas  -->
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                    <div id="AlertExito" class="alert alert-success" role="alert"
                                                        style="display:none">
                                                        <strong>Exitoso!</strong> Datos guardados con exito.
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                </div>
                                            </div>
                                            <!-- Barra de progreso -->
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div id="Progreso" class="preloader-single shadow-inner res-mg-b-30"
                                                        style="display:none">
                                                        <div class="ts_preloading_box">
                                                            <div id="ts-preloader-absolute14">
                                                                <div class="tsperloader14" id="tsperloader14_one"></div>
                                                                <div class="tsperloader14" id="tsperloader14_two"></div>
                                                                <div class="tsperloader14" id="tsperloader14_three">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                </div>
                                            </div> <br>
                                            <div id="Resultado" class="datatable-dashv1-list custom-datatable-overright"
                                                align="right">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cancelar -->
<div id="Cancelar" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                <h2>Cancelar!</h2>
                <p>¿Está seguro que desea cancelar? el archivo aun no se guarda</p>
            </div>
            <div class="modal-footer danger-md">
                <a data-dismiss="modal" href="#">Cancelar</a>
                <a href="Descarga_Reportes.php?Cancelar=Cancelar" class="external" >Aceptar</a>
            </div>
        </div>
    </div>
</div>



<?php include_once "Templete/Footer.php" ?>

<script>
    // Agregar
    $(document).on('submit', '#frmAjusteInv', function (event) {
        event.preventDefault();
        var datos = $('#frmAjusteInv').serialize();
        // alert(datos);
        $.ajax({
            url: "../SQLServer/Ajustes.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            xhr: function () {
                // obtener el objeto XmlHttpRequest nativo
                var xhr = $.ajaxSettings.xhr();
                // añadirle un controlador para el evento onprogress
                xhr.onprogress = function (evt) {
                    $("#Progreso").show();
                };
                // devolvemos el objeto xhr modificado
                return xhr;
            },
            success: function (data) {
                // alert(data);
                $("#Resultado").html(data);
                $("#BotonAgregar").hide();
                $("#BotonGuardar").show();
                $("#operacion").val("Guardar");
                $("#can").hide();
                $("#regresar").show();
                $("#Progreso").hide();
            }
        });
    });
</script>


<!-- Script boton a -->
<script type="text/javascript">
    $(document).ready(function () {
        $("a.external").click(function () {
            url = $(this).attr("href");
            window.open(url, '_blank');
            return false;
        });

        $("a.external").off('click');
    });
</script>