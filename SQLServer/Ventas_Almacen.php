<?php 
    include "Conexion.php";

    if (!empty($_POST['Almacen'])) {

        if (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT * from Corah_VentaUtilX
            WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND Rama='$Rama' AND Familia='$Familia'
            AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
            AND Fabricante='$Fabricante' AND FechaEmision='2019-07-02' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Articulos_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarArticulosAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
            
        <?php
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND ArtRama='$Rama' AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama'])
        && isset($_POST['Familia']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND ArtRama='$Rama' AND Familia='$Familia' AND Grupo='Grupo' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
        && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND ArtRama='$Rama' AND Familia='$Familia' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND ArtRama='$Rama' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php //
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Familia=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND Familia='$Familia' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND Grupo='$Grupo' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND Fabricante='$Fabricante' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            AND Familia='$Familia' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            AND Grupo='$Grupo' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            AND Fabricante='$Fabricante' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
            AND Grupo='$Grupo' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
            AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
            AND Fabricante='$Fabricante' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' 
            AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>


            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' 
            AND Fabricante='$Fabricante' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Fabricante=$_POST['Fabricante'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Fabricante='$Fabricante' 
            AND Proveedor='$Proveedor' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>

            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
        
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
        
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
        
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
            ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
        
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
        
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' 
            ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
        
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Proveedor=$_POST['Proveedor'];
        
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' 
            ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
        
        
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>

        <?php 
        } elseif (isset($_POST['Almacen']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Fabricante=$_POST['Fabricante'];
        
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Fabricante='$Fabricante' 
            ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
        
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        } elseif (isset($_POST['Almacen'])) {
            $Almacen=$_POST['Almacen'];
            $sqla= $pdo->prepare("SELECT * FROM Corah_VentaUtilX WHERE Almacen='$Almacen' ORDER BY Articulo ASC");
            $sqla->execute();
            $resultadoalm=$sqla->fetchALL(PDO::FETCH_ASSOC); ?>
    
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
                        <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
                    </div>
                </div>
                <div class="sparkline13-graph">
                    <div class="datatable-dashv1-list custom-datatable-overright" align="right">
        
                        <a class="btn btn-default align:center external" href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>" title="Descargar excel">
                            <!-- <i class="glyphicon glyphicon-export icon-share"></i> -->
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>
        
                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['CantidadX']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Ventas_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                        <!-- <button type="button" class="btn btn-custon-rounded-two btn-danger" data-toggle="modal"
                            data-target="#CancelarVentaAlm">
                            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                            Cancelar
                        </button> -->
                    </div>
                </div>
            </div>
        
        <?php
        }

    } else { ?>
    
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
                <h1>Lista <span class="table-project-n">de</span> Articulos</h1>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
                <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th>Articulo</th>
                            <th>Descripción</th>
                            <th>Precio Lista</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table> <br>
                <a class="btn btn-custon-two btn-primary external" href="../Interfaz/Ventas_Almacen.php">
                    <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                    Regresar 
                </a>
            </div>
        </div>
    </div>
    <?php 
    } ?>

    <!-- data table JS
	============================================ -->
    <script src="../js/tablas.js"></script>

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
