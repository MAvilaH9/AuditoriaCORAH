<?php 
    // session_start();
    include "Conexion.php"; 
    if(isset($_POST['Almacen'])){

        if(!empty($_POST['Almacen'] && $_POST['Articuloi'] && $_POST['Articulof'])){

            if (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
            && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) 
            && isset($_POST['Fabricante']) && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Proveedor=$_POST['Proveedor'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];


                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Grupo=<?php echo $Grupo;?>&Proveedor=<?php echo $Proveedor;?>
                                &Fabricante=<?php echo $Fabricante;?>&Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) && isset($_POST['Articuloi']) 
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Proveedor=$_POST['Proveedor'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];


                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>
                                &Familia=<?php echo $Familia;?>&Grupo=<?php echo $Grupo;?>
                                &Proveedor=<?php echo $Proveedor;?>&Articuloi=<?php echo $Articuloi;?>
                                &Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Articuloi']) 
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Grupo=<?php echo $Grupo;?>&Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            && isset($_POST['Familia']) && isset($_POST['Articuloi']) 
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Familia']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Familia=$_POST['Familia'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Familia='$Familia'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Familia=<?php echo $Familia;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Grupo']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Grupo=$_POST['Grupo'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Grupo='$Grupo'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Grupo=<?php echo $Grupo;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Proveedor']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Proveedor=$_POST['Proveedor'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Proveedor='$Proveedor'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Proveedor=<?php echo $Proveedor;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Fabricante']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Familia']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Familia='$Familia'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Grupo']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Rama=$_POST['Rama'];
                $Grupo=$_POST['Grupo'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Grupo='$Grupo'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Grupo=<?php echo $Grupo;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Proveedor']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Rama=$_POST['Rama'];
                $Proveedor=$_POST['Proveedor'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Proveedor='$Proveedor'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Proveedor=<?php echo $Proveedor;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Fabricante']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Rama=$_POST['Rama'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Grupo']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Grupo='$Grupo'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Grupo=<?php echo $Grupo;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Proveedor']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Familia=$_POST['Familia'];
                $Proveedor=$_POST['Proveedor'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Proveedor='$Proveedor'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Proveedor=<?php echo $Proveedor;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Fabricante']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Familia=$_POST['Familia'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Grupo=$_POST['Grupo'];
                $Proveedor=$_POST['Proveedor'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Proveedor='$Proveedor'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>&Proveedor=<?php echo $Proveedor;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Fabricante']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Grupo=$_POST['Grupo'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>&Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante']) 
            && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Proveedor=$_POST['Proveedor'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Proveedor=<?php echo $Proveedor;?>&Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen']; 
                $Categoria=$_POST['Categoria']; 
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX, FechaEmision ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Rama=$_POST['Rama'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>"
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Familia=$_POST['Familia'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Grupo=$_POST['Grupo'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Proveedor=$_POST['Proveedor']; 
                $Articuloi=$_POST['Articuloi']; 
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Proveedor=<?php echo $Proveedor;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Fabricante']) && isset($_POST['Articuloi'])
            && isset($_POST['Articulof'])) {

                $Almacen=$_POST['Almacen'];
                $Fabricante=$_POST['Fabricante'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Fabricante='$Fabricante'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Fabricante=<?php echo $Fabricante;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Articuloi'])  && isset($_POST['Articulof'])) {
                $Almacen=$_POST['Almacen'];
                $Articuloi=$_POST['Articuloi'];
                $Articulof=$_POST['Articulof'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
                AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
                GROUP BY Articulo, Descripcion1, CantidadX ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Articuloi=<?php echo $Articuloi;?>&Articulof=<?php echo $Articulof;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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

        } elseif (!empty($_POST['Almacen'])) {

            if (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
            && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante'])) {

                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Proveedor=$_POST['Proveedor'];
                $Fabricante=$_POST['Fabricante'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Grupo=<?php echo $Grupo;?>&Proveedor=<?php echo $Proveedor;?>
                                &Fabricante=<?php echo $Fabricante;?>&FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor'])) {
                
                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Rama=$_POST['Rama'];
                $Familia=$_POST['Familia'];
                $Grupo=$_POST['Grupo'];
                $Proveedor=$_POST['Proveedor'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Grupo=<?php echo $Grupo;?>&Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND Grupo='$Grupo' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &Grupo=<?php echo $Grupo;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
                AND Familia='$Familia' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Rama=<?php echo $Rama;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
            } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Familia'])) {
                $Almacen=$_POST['Almacen'];
                $Categoria=$_POST['Categoria'];
                $Familia=$_POST['Familia'];
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Familia='$Familia' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Familia=<?php echo $Familia;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Grupo='$Grupo' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Grupo=<?php echo $Grupo;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>"
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>&Fabricante=<?php echo $Fabricante;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Familia='$Familia' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Familia=<?php echo $Familia;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Grupo='$Grupo' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Grupo=<?php echo $Grupo;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];            

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Rama=<?php echo $Rama;?>&Fabricante=<?php echo $Fabricante;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Grupo='$Grupo' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Grupo=<?php echo $Grupo;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>&Fabricante=<?php echo $Fabricante;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>&Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>&Fabricante=<?php echo $Fabricante;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Proveedor=<?php echo $Proveedor;?>&Fabricante=<?php echo $Fabricante;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];

                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];
            
                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Categoria=<?php echo $Categoria;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];
            
                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'            
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Familia=<?php echo $Familia;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];
            
            
                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'            
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Grupo=<?php echo $Grupo;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];
            
                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Proveedor=<?php echo $Proveedor;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];
            
                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX 
                WHERE Almacen='$Almacen' AND Fabricante='$Fabricante' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &Fabricante=<?php echo $Fabricante;?>&FechaInicio=<?php echo $FechaInicio;?>
                                &FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                $FechaInicio=$_POST['FechaInicio'];
                $FechaFinal=$_POST['FechaFinal'];


                $sqla= $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
                FROM Corah_VentaUtilX WHERE Almacen='$Almacen' 
                AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
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
            
                            <a class="btn btn-default align:center external" 
                                href="../SQLServer/ExcVentas.php?Almacen=<?php echo $Almacen;?>
                                &FechaInicio=<?php echo $FechaInicio;?>&FechaFinal=<?php echo $FechaFinal;?>" 
                                title="Descargar excel">
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
                    <div class="main-sparkline13-hd"  style="text-align: center">
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
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Articulos_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                    </div>
                </div>
            </div>
        <?php 
        } 
        
    } else { ?>
            <div class="sparkline13-list">
                <div class="sparkline13-hd">
                    <div class="main-sparkline13-hd" style="text-align: center">
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
                        <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Articulos_Almacen.php">
                            <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                            Regresar 
                        </a>
                    </div>
                </div>
            </div>
            <script>
            Swal.fire({
                type: 'error',
                title: 'Tiene que seleccionar almacen',
                text: 'Error en el proceso!',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    setTimeout('document.location.reload()',1);
                }
            })
        </script>
    <?php
    }
    ?>



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



