<?php include "Templete/Header.php"; ?>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd" style="text-align: center">
                            <h1>Subir <span class="table-project-n">archivo</span> de reporte</h1>
                            <ul class="breadcome-menu">
                                <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a>
                                    <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Reportes</span>
                                </li>
                            </ul>
                        </div>
                    </div> <br> <br>
                    <!-- Formulario -->
                    <form id="frmExcel1" action="../Recursos/Exc.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro">Agregar Archivo Excel</label>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                    <div class="file-upload-inner ts-forms">
                                        <div class="input prepend-big-btn">
                                            <label class="icon-right" for="prepend-big-btn">
                                                <i class="fa fa-download"></i>
                                            </label>
                                            <div class="file-button">
                                                Agregar
                                                <input type="file" name="excel"
                                                    onchange="document.getElementById('prepend-big-btn').value = this.value;"
                                                    accept=".xlsx" required>
                                            </div>
                                            <input type="text" id="prepend-big-btn"
                                                placeholder="No se ha seleccionado ningun archivo">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="operacion" id="operacion" value="Agregar">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" id="BotonVer" class="btn btn-custon-rounded-two btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Agregar
                                    </button>
                                    <button type="submit" id="BotonGuardar" hidden
                                        class="btn btn-custon-rounded-two btn-success">
                                        <i class="fa fa-save" aria-hidden="true"></i>
                                        Guardar
                                    </button>
                                    <a id="can" class="btn btn-custon-rounded-two btn-danger external"
                                        href="../Interfaz/Index.php">
                                        <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                        Cancelar
                                    </a>
                                    <button type="button" id="regresar" hidden
                                        class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                                        data-target="#Cancelar">
                                        <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                        Cancelar
                                    </button>
                                    <button type="button" id="Rango" hidden
                                        class="btn btn-custon-rounded-two btn-primary">
                                        <!-- <i class="fa fa-times edu-danger-error" aria-hidden="true"></i> -->
                                        Rango
                                    </button>
                                </div>
                            </div> <br>
                            <div class="row" id="formrango" hidden>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">De Columna</label>
                                        <input name="ColInicio" id="ColInicio" type="text" tabindex="3"
                                            class="form-control" placeholder="Ingrese columna inicial">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">A Columna</label>
                                        <input name="ColFin" id="ColFin" type="text" tabindex="3"
                                            class="form-control" placeholder="Ingrese columna final">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">De Fila</label>
                                        <input name="FInicio" id="FInicio" type="text" tabindex="3"
                                            class="form-control" placeholder="Ingrese fila inicial">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label class="login2">A Fila</label>
                                        <input name="FFin" id="FFin" type="text" tabindex="3"
                                            class="form-control" placeholder="Ingrese fila final">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Barra de progreso -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div id="Progreso" class="preloader-single shadow-inner res-mg-b-30" style="display:none">
                                <div class="ts_preloading_box">
                                    <div id="ts-preloader-absolute14">
                                        <div class="tsperloader14" id="tsperloader14_one"></div>
                                        <div class="tsperloader14" id="tsperloader14_two"></div>
                                        <div class="tsperloader14" id="tsperloader14_three"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        </div>
                    </div>
                    <br>
                    <div id="tabla" class="datatable-dashv1-list custom-datatable-overright">
                    </div>
                </div>
            </div>
        </div>
    </div> <br>

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
                    <p>¿Está seguro que desea cancelar?, el archivo aun no se guarda</p>
                </div>
                <div class="modal-footer danger-md">
                    <a data-dismiss="modal" href="#">Cancelar</a>
                    <a href="Exc.php" class="external">Aceptar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rango -->
    <div id="Rango" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                    <h2>Cancelar!</h2>
                    <p>¿Está seguro que desea cancelar?, el archivo aun no se guarda</p>
                </div>
                <div class="modal-footer danger-md">
                    <a data-dismiss="modal" href="#">Cancelar</a>
                    <a href="Exc.php" class="external">Aceptar</a>
                </div>
            </div>
        </div>
    </div>

    <?php include "Templete/Footer.php"; ?>

    <script>
        // Agregar
        $(document).on('submit', '#frmExcel1', function (event) {
            event.preventDefault();
            var datos = $('#frmExcel1').serialize();

            $("#Rango").click(function (e) {
                $("#formrango").show();
            });
            alert(datos);
            $.ajax({
                url: "../SQLServer/Exc.php",
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
                    $("#tabla").html(data);
                    $("#BotonVer").hide();
                    $("#BotonGuardar").show();
                    $("#operacion").val("Guardar");
                    $("#can").hide();
                    $("#regresar").show();
                    $("#Progreso").hide();
                    $("#Rango").show();
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