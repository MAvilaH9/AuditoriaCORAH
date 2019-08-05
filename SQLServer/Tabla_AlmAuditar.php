<?php
    session_start();
    require_once "Conexion.php";
    
    $sql= $pdo->prepare("SELECT s.Nombre as Sucursal, a.Nombre as Almacen,
    u.Nombre as Auditor, ca.Fecha from CalendarioAuditar ca
    inner join Sucursal s on s.Sucursal=ca.Sucursal
    inner join Alm a on a.Almacen=ca.Almacen
    inner join Usuario u on ca.Usuario=u.Usuario ORDER BY Fecha ASC");
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
                    <button  title="Editar" class="pd-setting-ed" id="Editar" name="editar" data-id="<?php echo $dato['IdAuditar'];?>"> 
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                    </button>

                    <button id="Eliminar" data-id="<?php echo $dato['IdAuditar']; ?>" title="Eliminar"
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

