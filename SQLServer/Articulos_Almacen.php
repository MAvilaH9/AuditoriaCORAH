<?php 
    // session_start();
    include "Conexion.php"; 
    if(!empty($_POST['Almacen'] && $_POST['Articuloi'] && $_POST['Articulof'])){

        if (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) 
        && isset($_POST['Fabricante']) && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo' AND p.Nombre='$Proveedor' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) && isset($_POST['Articuloi']) 
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo' AND p.Nombre='$Proveedor' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Articuloi']) 
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Familia']) && isset($_POST['Articuloi']) 
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Familia']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Familia=$_POST['Familia'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Familia='$Familia'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Grupo']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Grupo=$_POST['Grupo'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Proveedor']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' AND p.Nombre='$Proveedor' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Fabricante']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Familia']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Rama='$Rama' 
            AND a.Familia='$Familia'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Grupo']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Grupo=$_POST['Grupo'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Rama='$Rama' AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Proveedor']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Rama='$Rama' AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Fabricante']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Rama='$Rama' AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Grupo']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Familia='$Familia' AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Proveedor']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Familia='$Familia' AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Fabricante']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Familia='$Familia' AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Grupo='$Grupo' AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Fabricante']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Grupo='$Grupo' AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante']) 
        && isset($_POST['Articuloi']) && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Proveedor=$_POST['Proveedor'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Nombre='$Proveedor' AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        }
        
         elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen']; $Almacen=trim($Almacen);
            $Categoria=$_POST['Categoria']; $Categoria=trim($Categoria);
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, Convert(decimal(10,2),a.PrecioLista) PrecioLista,
            va.Disponible, ISNULL(va.Reservado,0) AS Reservado
            FROM ArtDisponibleReservado va INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Categoria='$Categoria'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, va.Disponible, va.Reservado ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                        &Articuloi=<?php echo $Articuloi?>&Articulof=<?php echo $Articulof?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {
                                    $Stock=$datoalm['Disponible'] + $datoalm['Reservado'];
                                ?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista'];?></td>
                                    <td><?php echo $Stock ?></td>
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
        } 
        
        elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Rama='$Rama'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Familia='$Familia'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Proveedor=$_POST['Proveedor'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Fabricante']) && isset($_POST['Articuloi'])
        && isset($_POST['Articulof'])) {

            $Almacen=$_POST['Almacen'];
            $Fabricante=$_POST['Fabricante'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Articuloi'])  && isset($_POST['Articulof'])) {
            $Almacen=$_POST['Almacen'];
            $Articuloi=$_POST['Articuloi'];
            $Articulof=$_POST['Articulof'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,  
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Articulo BETWEEN '$Articuloi' AND '$Articulof'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista, a.Articulo ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Articuloi=<?php echo $Articuloi?>
                            &Articulof=<?php echo $Articulof?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        }

    } elseif (!empty($_POST['Almacen'])) {

        $Fecha = date("d-m-Y");

        if (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama']) 
        && isset($_POST['Familia']) && isset($_POST['Grupo']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante'])) {

            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on p.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo' AND p.Nombre='$Proveedor' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Rama=<?php echo $Rama?>&Familia=<?php echo $Familia?>&Grupo=<?php echo $Grupo?>&Proveedor=<?php echo $Proveedor?>
                            &Fabricante=<?php echo $Fabricante?>" 
                            title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo' AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Rama=<?php echo $Rama?>&Familia=<?php echo $Familia?>&Grupo=<?php echo $Grupo?>
                            &Proveedor=<?php echo $Proveedor?>"
                            title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Familia']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Rama=<?php echo $Rama?>&Familia=<?php echo $Familia?>&Grupo=<?php echo $Grupo?>" 
                            title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];
            $Famila=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' AND a.Familia='$Famila'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Rama=<?php echo $Rama?>&Familia=<?php echo $Familia?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Rama'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Rama=$_POST['Rama'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Rama='$Rama' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Rama=<?php echo $Rama?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Familia=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Familia='$Familia' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Familia=<?php echo $Familia?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Grupo=<?php echo $Grupo?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Proveedor=<?php echo $Proveedor?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>
                            &Fabricante=<?php echo $Fabricante?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Familia=$_POST['Familia'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Rama='$Rama' 
            AND a.Familia='$Familia'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>
                            &Rama=<?php echo $Rama?>&Familia=<?php echo $Familia?>" 
                            title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Rama='$Rama' 
            AND a.Grupo='$Grupo' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>
                            &Rama=<?php echo $Rama?>&Grupo=<?php echo $Grupo?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Rama='$Rama' 
            AND ap.Proveedor='$Proveedor' ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>
                            &Rama=<?php echo $Rama?>&Proveedor=<?php echo $Proveedor?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Rama='$Rama' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>
                            &Rama=<?php echo $Rama?>&Fabricante=<?php echo $Fabricante?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Grupo=$_POST['Grupo'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Familia='$Familia' 
            AND a.Grupo='$Grupo' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Familia=<?php echo $Familia?>
                        &Grupo=<?php echo $Grupo?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Familia='$Familia' 
            AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Familia=<?php echo $Familia?>
                            &Proveedor=<?php echo $Proveedor?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Familia='$Familia' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista  ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Familia=<?php echo $Familia?>
                            &Fabricante=<?php echo $Fabricante?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Grupo='$Grupo' 
            AND p.Nombre='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Grupo=<?php echo $Grupo?>
                            &Proveedor=<?php echo $Proveedor?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
            $Fabricante=$_POST['Fabricante'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Grupo='$Grupo' 
            AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Grupo=<?php echo $Grupo?>
                            &Fabricante=<?php echo $Fabricante?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Fabricante=$_POST['Fabricante'];
            $Proveedor=$_POST['Proveedor'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Fabricante='$Fabricante' 
            AND a.Proveedor='$Proveedor'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>
                            &Proveedor=<?php echo $Proveedor?>&Fabricante=<?php echo $Fabricante?>" 
                        title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Categoria'])) {
            $Almacen=$_POST['Almacen'];
            $Categoria=$_POST['Categoria'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Categoria='$Categoria'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                        href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Categoria=<?php echo $Categoria?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Rama'])) {
            $Almacen=$_POST['Almacen'];
            $Rama=$_POST['Rama'];
        
            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Rama='$Rama'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Rama=<?php echo $Rama?>"
                            title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true"
                            data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external"
                            href="../Interfaz/Articulos_Almacen.php">
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Familia'])) {
            $Almacen=$_POST['Almacen'];
            $Familia=$_POST['Familia'];
        
            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Familia='$Familia'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Familia=<?php echo $Familia?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true"
                            data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external"
                            href="../Interfaz/Articulos_Almacen.php">
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Grupo'])) {
            $Almacen=$_POST['Almacen'];
            $Grupo=$_POST['Grupo'];
        
            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista, 
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Grupo='$Grupo'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Grupo=<?php echo $Grupo?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true"
                            data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external"
                            href="../Interfaz/Articulos_Almacen.php">
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Proveedor'])) {
            $Almacen=$_POST['Almacen'];
            $Proveedor=$_POST['Proveedor'];
        
            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista, 
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND p.Nombre='$Proveedor' 
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Proveedor=<?php echo $Proveedor?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true"
                            data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external"
                            href="../Interfaz/Articulos_Almacen.php">
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
        } elseif (isset($_POST['Almacen']) && isset($_POST['Fabricante'])) {
            $Almacen=$_POST['Almacen'];
            $Fabricante=$_POST['Fabricante'];
        
            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista, 
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen' AND a.Fabricante='$Fabricante'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>&Fabricante=<?php echo $Fabricante?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true"
                            data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true"
                            data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table> <br>
                        <a class="btn btn-custon-rounded-two btn-danger external"
                            href="../Interfaz/Articulos_Almacen.php">
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
        } elseif (isset($_POST['Almacen'])) {
            $Almacen=$_POST['Almacen'];

            $sqla= $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista,  
            SUM(Disponible + ISNULL(Reservado,0)) as Stock
            FROM ArtDisponibleReservado va  INNER JOIN Art a ON a.Articulo=va.Articulo 
            inner join ArtCat cat on a.Categoria=cat.Categoria
            inner join ArtProv ap on a.Articulo=ap.Articulo
            inner join Prov p on ap.Proveedor=p.Proveedor
            WHERE va.Almacen='$Almacen'
            GROUP BY a.Articulo, a.Descripcion1, a.PrecioLista ORDER BY a.Articulo ASC");
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
                            href="../SQLServer/ExcArticulos.php?Almacen=<?php echo $Almacen?>" title="Descargar excel">
                            <i class="fa fa-cloud-download edu-check-icon"></i>
                        </a>

                        <table id="table" data-toggle="table" data-pagination="true" data-key-events="true" data-cookie="true"
                            data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Descripción</th>
                                    <th>Precio Lista</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultadoalm as $datoalm) {?>
                                <tr>
                                    <td><?php echo $datoalm['Articulo']; ?></td>
                                    <td><?php echo $datoalm['Descripcion1']; ?></td>
                                    <td><?php echo $datoalm['PrecioLista']; ?></td>
                                    <td><?php echo $datoalm['Stock']; ?></td>
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
                    <a class="btn btn-custon-rounded-two btn-danger external" href="../Interfaz/Articulos_Almacen.php">
                        <i class="fa fa-angle-left edu-icon edu-down-arrow" aria-hidden="true"></i>
                        Regresar 
                    </a>
                </div>
            </div>
        </div>
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



