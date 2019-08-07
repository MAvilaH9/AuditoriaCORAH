<?php
    session_start();
    require_once "Conexion_Auditoria.php";
    $sql= $pdo->prepare("SELECT * FROM Empresa ORDER BY NombreEmpresa ASC");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
?>

    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true" data-cookie-id-table="saveId"  data-click-to-select="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th>Nombre de la Empresa</th>
                <th>Nombre de la Base de Datos</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $dato) {?>
            <tr>
                <td><?php echo $dato['NombreEmpresa'];?></td>
                <td><?php echo $dato['NombreBaseDatos'];?></td>

                <td>
                    <button  title="Editar" class="pd-setting-ed" id="Editar" name="editar" data-id="<?php echo $dato['IdEmpresa'];?>"> 
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                    </button>

                    <button id="Eliminar" data-id="<?php echo $dato['IdEmpresa']; ?>" title="Eliminar"
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

