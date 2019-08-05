<?php
    session_start();
    require_once "Conexion.php";
    
    $sql= $pdo->prepare("SELECT ca.IdCalendarioAuditar, s.Nombre as Sucursal, a.Nombre as Almacen, 
    u.Nombre as Auditor, ca.Fecha
    FROM CalendarioAuditar ca INNER JOIN Sucursal s ON ca.Sucursal=s.Sucursal
    INNER JOIN Alm a ON a.Almacen=ca.Almacen 
    INNER JOIN Usuario u ON u.Usuario=ca.Usuario
    ORDER BY DATEPART(m,Fecha), DATEPART(d,Fecha) ASC");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
?>

    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true" data-cookie-id-table="saveId"  data-click-to-select="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Almacen</th>
                <th>Auditor</th>
                <th>Fecha de Auditoria</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $dato) {?>
            <tr>
                <td><?php echo $dato['Sucursal'];?></td>
                <td><?php echo $dato['Almacen'];?></td>
                <td><?php echo $dato['Auditor'];?></td>
                <td><?php echo $dato['Fecha'];?></td>
                <td>
                    <button  title="Editar" class="pd-setting-ed" id="Editar" name="editar" data-id="<?php echo $dato['IdCalendarioAuditar'];?>"> 
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                    </button>

                    <button id="Eliminar" data-id="<?php echo $dato['IdCalendarioAuditar']; ?>" title="Eliminar"
                        class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <?php 
            } ?>
        
        </tbody>
        
    </table> <br>
        

    <!-- data table JS
	============================================ -->
    <script src="../js/tablas.js"></script>

