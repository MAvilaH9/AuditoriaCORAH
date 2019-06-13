<?php
    session_start();
    require_once "Conexion.php";
    $sql= $conn->prepare("SELECT IdUsuario, Nombres, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasenia FROM Usuario ORDER BY IdUsuario ASC");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
?>


    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true"
    data-cookie-id-table="saveId"  data-click-to-select="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre (s)</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $dato) {?>
            <tr>
                <td><?php echo $dato['IdUsuario'];?></td>
                <td><?php echo $dato['ApellidoPaterno'];?></td>
                <td><?php echo $dato['ApellidoMaterno'];?></td>
                <td><?php echo $dato['Nombres'];?></td>
                <td><?php echo $dato['Usuario'];?></td>
                <td><?php echo $dato['Contrasenia'];?></td>
                <td>
                    <button  title="Editar" class="pd-setting-ed" id="Editar" name="editar" data-id="<?php echo $dato['IdUsuario'];?>"> 
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                    </button>

                    <button id="Eliminar" data-id="<?php echo $dato['IdUsuario']; ?>" title="Eliminar"
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

