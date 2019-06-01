<?php 
    require_once ("Conexion.php");
    $sql= $pdo->prepare("SELECT IdUsuario, Nombres, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasenia FROM usuario ORDER BY IdUsuario ASC");
    $sql->execute();
    $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);

    echo "
    <table  data-toggle='table' data-pagination='true' data-search='true' data-key-events='true' data-cookie='true'
    data-cookie-id-table='saveId' data-click-to-select='true' data-toolbar='#toolbar'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre (s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>";
        foreach ($resultado as $dato) {
        echo"
        <tr>
            <td>". $dato['IdUsuario']."</td>
            <td>". $dato['Nombres']."</td>
            <td>". $dato['ApellidoPaterno']."</td>
            <td>". $dato['ApellidoMaterno']."</td>
            <td>". $dato['Usuario']."</td>
            <td>". $dato['Contrasenia']."</td>
            <td>
                <button id='Editar' data-id='".$dato['IdUsuario']."' title='Editar' class='pd-setting-ed'>
                    <i class='fa fa-pencil-square-o'aria-hidden='true'></i>
                </button>
                <button id='Eliminar' data-id='".$dato['IdUsuario']."' title='Eliminar'
                    class='pd-setting-ed'><i class='fa fa-trash-o' aria-hidden='true'></i>
                </button>
            </td>
        </tr>";
        }
    
    echo '</tbody>
        </table> <br>';
        
?>

    <!-- data table JS
	============================================ -->
    <script src="../js/tablas.js"></script>
    <script src="../js/tableExport.js"></script> 
    <script src="../js/data-table-active.js"></script>
    <script src="../js/bootstrap-table-editable.js"></script> 
    <script src="../js/bootstrap-editable.js"></script>
    <script src="../js/bootstrap-table-resizable.js"></script>
    <script src="../js/colResizable-1.5.source.js"></script>
    <script src="../js/bootstrap-table-export.js"></script>
