<?php include_once "Templete/Header.php"; 
require "../SQLServer/Conexion.php";
?>
<br>
<!-- Espacio paraFormularios -->

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="Titulo" class="product-payment-inner-st">
                    <ul class="breadcome-menu">
                        <li><a href="Index.php" data-toggle="tooltip" title="Regresar al inicio">Inicio</a> <span class="bread-slash">/</span>
                        </li>
                        <li><span class="bread-blod">Articulos Almacen</span>
                        </li>
                    </ul>
                    <!--  Tìtulo -->
                    <ul id="myTabedu1" class="tab-review-design" style="text-align: center">
                        <li class="active"><a>Articulos Almacen</a></li>
                    </ul>
                    <!-- Formulario para la Consula  -->
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <form id="frmArticulosAlm" class="dropzone dropzone-custom needsclick add-professors">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <!-- Select Sucursal -->
                                                        <?php 
                                                            // $Empresa = $_SESSION['Empresa'];
                                                            $sqlsuc= $pdo->prepare("SELECT Sucursal, Nombre from Sucursal ORDER BY Nombre ASC");
                                                            $sqlsuc->execute();
                                                            $resultadosuc=$sqlsuc->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Sucursal</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Sucursal" id="Sucursal" class="form-control" tabindex="1">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                        Sucursal</option>
                                                                    <?php 
                                                                    foreach ($resultadosuc as $datosuc) {
                                                                        echo '<option value="'.$datosuc['Sucursal'].'">'.$datosuc['Nombre'].'</option>';
                                                                    }?>                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Text Articulo -->
                                                        <div class="form-group">
                                                            <label class="login2">Del Artículo</label>
                                                            <input name="Articuloi" id="Articuloi" type="text" tabindex="3"
                                                                class="form-control" placeholder="Ingrese el artículo">
                                                        </div>
                                                        <!-- Text Categoria -->
                                                        <?php 
                                                            $sqlcat= $pdo->prepare("SELECT Categoria FROM ArtCat ORDER BY Categoria ASC");
                                                            $sqlcat->execute();
                                                            $resultadocat=$sqlcat->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Categoría</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Categoria" id="Categoria"
                                                                    class="chosen-select" tabindex="5">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione Categoría</option>
                                                                    <?php 
                                                                    foreach ($resultadocat as $cat) {
                                                                        echo '<option value="'.$cat['Categoria'].'">'.$cat['Categoria'].'</option>';
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Select Familia -->
                                                        <?php 
                                                            $sqlfam= $pdo->prepare("SELECT Familia FROM ArtFam ORDER BY Familia ASC");
                                                            $sqlfam->execute();
                                                            $resultadofam=$sqlfam->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Familia</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Familia" id="Familia"
                                                                    class="chosen-select" tabindex="7">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione
                                                                        Familia
                                                                    </option>
                                                                    <?php 
                                                                    foreach ($resultadofam as $fam) {
                                                                        echo '<option value="'.$fam['Familia'].'">'.$fam['Familia'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Select Proveedor -->
                                                        <?php 
                                                            $sqlpro= $pdo->prepare("SELECT Nombre FROM Prov ORDER BY Nombre ASC");
                                                            $sqlpro->execute();
                                                            $resultadopro=$sqlpro->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Proveedor</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Proveedor" id="Proveedor"
                                                                    class="chosen-select" tabindex="9">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione Proveedor
                                                                    </option>
                                                                    <?php 
                                                                    foreach ($resultadopro as $pro) {
                                                                        echo '<option value="'.$pro['Nombre'].'">'.$pro['Nombre'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <?php 
                                                            // $Empresa=$_SESSION['Empresa'];                                                           
                                                            $sql= $pdo->prepare("SELECT Almacen, Nombre FROM Alm ORDER BY Nombre ASC");
                                                            $sql->execute();
                                                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <!-- Select Almacen -->
                                                        <div class="form-group">
                                                            <label class="login2">Almacen</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Almacen" id="Almacen" required
                                                                    class="form-control" tabindex="2">
                                                                    <option value="none" selected="" disabled="">Seleccione
                                                                        Almacen</option>
                                                                    <?php 
                                                                    foreach ($resultado as $dato) {
                                                                        echo '<option value="'.$dato['Almacen'].'">'.$dato['Nombre'].'</option>';
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Text Articulo -->
                                                        <div class="form-group">
                                                            <label class="login2">Al Artículo</label>
                                                            <input name="Articulof" id="Articulof" type="text" tabindex="4"
                                                                class="form-control" placeholder="Ingrese el artículo">
                                                        </div>
                                                        <!-- Select Rama -->
                                                        <?php 
                                                            $sqlram= $pdo->prepare("SELECT Cuenta FROM ArtRama ORDER BY Cuenta ASC");
                                                            $sqlram->execute();
                                                            $resultadoram=$sqlram->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Rama</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Rama" id="Rama" class="chosen-select"
                                                                    tabindex="6">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione
                                                                        Rama
                                                                    </option>
                                                                    <?php 
                                                                    foreach ($resultadoram as $ram) {
                                                                        echo '<option value="'.$ram['Cuenta'].'">'.$ram['Cuenta'].'</option>';
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Select Grupo -->
                                                        <?php 
                                                            $sqlgpo= $pdo->prepare("SELECT Grupo FROM ArtGrupo ORDER BY Grupo ASC");
                                                            $sqlgpo->execute();
                                                            $resultadogpo=$sqlgpo->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Grupo</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Grupo" id="Grupo" class="chosen-select"
                                                                    tabindex="8">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione
                                                                        Grupo
                                                                    </option>
                                                                    <?php
                                                                    foreach ($resultadogpo as $gpo) {
                                                                        echo '<option value="'.$gpo['Grupo'].'">'.$gpo['Grupo'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Select Fabricante -->
                                                        <?php 
                                                            $sqlfab= $pdo->prepare("SELECT Fabricante FROM Fabricante ORDER BY Fabricante ASC");
                                                            $sqlfab->execute();
                                                            $resultadofab=$sqlfab->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Fabricante</label>
                                                            <div class="chosen-select-single mg-b-20">
                                                                <select name="Fabricante" id="Fabricante"
                                                                    class="chosen-select" tabindex="10">
                                                                    <option value="none" selected="" disabled="">
                                                                        Seleccione
                                                                        Fabricante
                                                                    </option>
                                                                    <?php
                                                                    foreach ($resultadofab as $fab) {
                                                                        echo '<option value="'.$fab['Fabricante'].'">'.$fab['Fabricante'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
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
                                                                    <br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button type="button" tabindex="14"
                                                                        class="btn btn-custon-rounded-two btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#CancelarArticulosSuc">
                                                                        <i class="fa fa-times edu-danger-error"
                                                                            aria-hidden="true"></i>
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" id="Consular" tabindex="13"
                                                                        class="btn btn-custon-rounded-two btn-success">
                                                                        <i class="fa fa-check edu-checked-pro"
                                                                            aria-hidden="true"></i>
                                                                        Consultar
                                                                    </button>
                                                                    <!-- <button type="button"
                                                                        class="btn btn-custon-rounded-two btn-primary">
                                                                        <i class="fa fa-cloud-download edu-check-icon"
                                                                            aria-hidden="true"></i>
                                                                        Exportar Excel
                                                                    </button> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Resultado" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            </div>
        </div>
    </div>
</div>


<!-- Modal Cancelar Consulta Sucursal -->

<div id="CancelarArticulosSuc" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                <h2>Cancelar Consulta!</h2>
                <p>¿Está seguro que desea cancelar la consulta?</p>
            </div>
            <div class="modal-footer danger-md">
                <a data-dismiss="modal" href="#">Cancelar</a>
                <a href="Index.php" class="external" >Aceptar</a>
            </div>
        </div>
    </div>
</div>

<?php include_once "Templete/Footer.php"; ?>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<!-- Combos Dinamicos -->
<script language="javascript">
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

<!-- Envia formulario para realizar la consulta -->
<script type="text/javascript" language="javascript">

    $(document).ready(function () {

        $(document).on('submit', '#frmArticulosAlm', function (e) {
            e.preventDefault();
            var datos = $('#frmArticulosAlm').val();
            // alert(datos);
            $.ajax({
                type: "Post",
                url: "../SQLServer/Articulos_Almacen.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                xhr: function(){
                    // obtener el objeto XmlHttpRequest nativo
                    var xhr = $.ajaxSettings.xhr() ;
                    // añadirle un controlador para el evento onprogress
                    xhr.onprogress = function(evt){ 
                        $("#Progreso").show();
                        $("#frmArticulosAlm").hide();
                    };
                    // devolvemos el objeto xhr modificado
                    return xhr ;
                },
                success: function (resp) {
                    // alert(resp);
                    $('#frmArticulosAlm')[0].reset();
                    $('#frmArticulosAlm').hide();
                    $('#Titulo').hide();
                    $('#Resultado').html(resp);
                },
            });
        });
    });
    
</script>

<!-- Boton Aceptar del modal cancelar consulta-->
<script type="text/javascript">

    $(document).ready(function(){
        $("a.external").click(function() {
            url = $(this).attr("href");
            window.open(url,'_blank');
            return false;
        });
        
        $("a.external").off('click');
    });

</script>

