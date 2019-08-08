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
                                <li><span class="bread-blod">Subir Reportes</span>
                                </li>
                            </ul>
                        </div>
                    </div> <br> <br>
                    <!-- Formulario -->
                    <form id="frmExcel">
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
                                                <input type="file" name="Archivo" required
                                                    onchange="document.getElementById('prepend-big-btn').value = this.value;"
                                                    accept=".xlsx">
                                            </div>
                                            <input type="text" id="prepend-big-btn"
                                                placeholder="No se ha seleccionado ningun archivo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="action" id="action" value="Add"
                                        class="btn btn-custon-rounded-two btn-success">
                                        <i class="fa fa-save" aria-hidden="true"></i>
                                        Guardar
                                    </button>
                                    <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Index.php">
                                        <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </div> <br> <br>
                            <!-- Alertas  -->
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div id="AlertExito" class="alert alert-success" role="alert" style="display:none">
                                        <strong>Exitoso!</strong> Archivo guardados con exito
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
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div> <br>

    <?php include "Templete/Footer.php"; ?>

    <script>
        // Agregar
        $(document).on('submit', '#frmExcel', function (event) {
            event.preventDefault();
            var datos = $('#frmExcel').serialize();
            // alert(datos);
            $.ajax({
                url: "../SQLServer/Reportes.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    // alert(data);
                    $('#frmExcel')[0].reset();
                    if (data == 1) {
                        $("#AlertExito").fadeIn();
                        setTimeout(function () {
                            $("#AlertExito").fadeOut();
                        }, 2000);
                        $("#tabla").html(data);
                    } else if (data == 2) {
                        $("#AlertError").fadeIn();
                        setTimeout(function () {
                            $("#AlertError").fadeOut();
                        }, 2000);
                    }else{
                        $("#AlertArcExistente").fadeIn();
                        setTimeout(function () {
                            $("#AlertArcExistente").fadeOut();
                        }, 2000);
                    }
                }
            });
        });
        
    </script>
    <script>
        $(document).ready(function(){
            $("a.external").click(function() {
                url = $(this).attr("href");
                window.open(url,'_blank');
                return false;
            });
            
            $("a.external").off('click');
        });
    </script>