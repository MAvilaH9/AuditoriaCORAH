<?php include_once "Templete/Header.php"; 
require "../Recursos/Conexion.php";
?>
<br>
<!-- Espacio paraFormularios -->

<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <ul id="myTabedu1" class="tab-review-design">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="active"><a>Reporte de Auditoría</a></li>
                    </ul>
                            
                    <!-- Formulario para la Consula  -->
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <form action="#" class="dropzone dropzone-custom needsclick add-professors"
                                                id="demo1-upload">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <?php 
                                                            $sql= $pdo->prepare("SELECT Almacen, Nombre FROM almacen ORDER BY Nombre ASC");
                                                            $sql->execute();
                                                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <!-- Select Almacen -->
                                                        <div class="form-group">
                                                            <label class="login2">Almacén</label>
                                                            <select name="Almacen" id="Almacen" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Almacen</option>
                                                                <?php 
                                                                foreach ($resultado as $dato) {
                                                                    echo '<option value="'.$dato['Almacen'].'">'.$dato['Nombre'].'</option>';
                                                                }?>
                                                            </select>
                                                        </div>
                                                        <!-- Text Articulo -->
                                                        <div class="form-group">
                                                            <label class="login2">Del Artículo</label>
                                                            <input name="Articuloi" id="Articuloi" type="text" class="form-control" placeholder="Ingrese el artículo">
                                                        </div>
                                                        <!-- Text Categoria -->
                                                        <?php 
                                                            $sqlcat= $pdo->prepare("SELECT IdCategoria, Categoria FROM categoria ORDER BY Categoria ASC");
                                                            $sqlcat->execute();
                                                            $resultadocat=$sqlcat->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Categoría</label>
                                                            <select name="Categoria" id="Categoria" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione Categoría</option>
                                                                <?php 
                                                                foreach ($resultadocat as $cat) {
                                                                    echo '<option value="'.$cat['IdCategoria'].'">'.$cat['Categoria'].'</option>';
                                                                }?>
                                                            </select>
                                                        </div>
                                                        <!-- Select Familia -->
                                                        <?php 
                                                            $sqlfam= $pdo->prepare("SELECT IdFamilia, Familia FROM familia ORDER BY Familia ASC");
                                                            $sqlfam->execute();
                                                            $resultadofam=$sqlfam->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Familia</label>
                                                            <select name="Familia" id="Familia" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Familia
                                                                </option>
                                                                <?php 
                                                                foreach ($resultadofam as $fam) {
                                                                    echo '<option value="'.$fam['IdFamilia'].'">'.$fam['Familia'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- Select Proveedor -->
                                                        <?php 
                                                            $sqlpro= $pdo->prepare("SELECT IdProveedor, Nombre FROM proveedor ORDER BY Nombre ASC");
                                                            $sqlpro->execute();
                                                            $resultadopro=$sqlpro->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Proveedor</label>
                                                            <select name="Proveedor" id="Proveedor" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Proveedor
                                                                </option>
                                                                <?php 
                                                                foreach ($resultadopro as $pro) {
                                                                    echo '<option value="'.$pro['IdProveedor'].'">'.$pro['Nombre'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <!-- Select Excluir -->
                                                        <div class="form-group">
                                                            <label class="login2">Excluir Planeación</label>
                                                            <select name="Excluir" id="Excluir" class="form-control">
                                                                <option value="0" Selected>Si</option>
                                                                <option value="1">No</option>
                                                            </select>
                                                        </div>
                                                        <!-- Select Articulo -->
                                                        <div class="form-group">
                                                            <label class="login2">Al Artículo</label>
                                                            <input name="Articulof" id="Articulof" type="text" class="form-control" placeholder="Ingrese el artículo">
                                                        </div>
                                                        <!-- Select Rama -->
                                                        <?php 
                                                            $sqlram= $pdo->prepare("SELECT IdRama, Nombre FROM rama ORDER BY Nombre ASC");
                                                            $sqlram->execute();
                                                            $resultadoram=$sqlram->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Rama</label>
                                                            <select name="Rama" id="Rama" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Rama
                                                                </option>
                                                                <?php 
                                                                foreach ($resultadoram as $ram) {
                                                                    echo '<option value="'.$ram['IdRama'].'">'.$ram['Nombre'].'</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- Select Grupo -->
                                                        <?php 
                                                            $sqlgpo= $pdo->prepare("SELECT IdGrupo, Grupo FROM grupo ORDER BY Grupo ASC");
                                                            $sqlgpo->execute();
                                                            $resultadogpo=$sqlgpo->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Grupo</label>
                                                            <select name="Grupo" id="Grupo" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Grupo
                                                                </option>
                                                                <?php
                                                                foreach ($resultadogpo as $gpo) {
                                                                    echo '<option value="'.$gpo['IdGrupo'].'">'.$gpo['Grupo'].'</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- Select Fabricante -->
                                                        <?php 
                                                            $sqlfab= $pdo->prepare("SELECT IdFabricante, Fabricante FROM fabricante ORDER BY Fabricante ASC");
                                                            $sqlfab->execute();
                                                            $resultadofab=$sqlfab->fetchALL(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="login2">Fabricante</label>
                                                            <select name="Fabricante" id="Fabricante" class="form-control">
                                                                <option value="none" selected="" disabled="">Seleccione
                                                                    Fabricante
                                                                </option>
                                                                <?php
                                                                foreach ($resultadofab as $fab) {
                                                                    echo '<option value="'.$fab['IdFabricante'].'">'.$fab['Fabricante'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
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
                                                                    <a href="TablaAuditoria.php"
                                                                        class="btn btn-custon-rounded-two btn-success">
                                                                        <i class="fa fa-check edu-checked-pro"
                                                                            aria-hidden="true"></i>
                                                                        Consultar
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-custon-rounded-two btn-danger" data-toggle="modal" data-target="#CancelarConsulta">
                                                                        <i class="fa fa-times edu-danger-error"
                                                                            aria-hidden="true"></i>
                                                                        Cancelar
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

<div id="CancelarConsulta" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
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
                <a href="Index.php">Aceptar</a>
            </div>
        </div>
    </div>
</div>

<script language="javascript">

// Municipio
// $(document).ready(function () {
//     $("#Almacen").change(function () { 
//         // e.preventDefault();

//         $("#Almacen option:selected").each(function () {
//             id_estado = $(this).val();
//             $.post("../Recursos/Prueba.php",{ id_estado: id_estado},
//             function(data){
//                 $("#Categoria").html(data);
//             });            
//         });
//     });
// });

// $(document).ready(function () {
//     $("#Categoria").change(function () {
        
//         $("#Categoria option:selected").each(function () {
//             id_municipio = $(this).val();
//             $.post("../Recursos/Prueba2.php",{ id_municipio: id_municipio},
//             function(data) {
//                 $("#Rama").html(data);
//             });
            
//         });
        
//     });
// });

</script>

<?php include_once "Templete/Footer.php"; ?>