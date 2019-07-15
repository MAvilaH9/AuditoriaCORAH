<?php session_start();

    if ($_SESSION['IdPerfil']== 1 || $_SESSION['Perfil']==1) { ?>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true"
        data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th>Archivo</th>
                <th>Descargar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directorio = opendir("../Formatos/"); //ruta actual
            while ($archivo = readdir($directorio)){ //obtenemos un archivo y luego otro sucesivamente
                if ($archivo != "." && $archivo !="..") { ?>
                <tr>
                    <td> <i class="fa fa-file-excel-o text-success"></i> &nbsp;<?php echo $archivo ?></td>
                    <td>
                        <a title="Descargar" class="pd-setting-ed external" href="Descarga_Formatos.php?Archivo=<?php echo $archivo; ?>">
                            <i class="fa fa-cloud-download edu-check-icon" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <button id="Eliminar" data-id="<?php echo $archivo; ?>" title="Eliminar" class="pd-setting-ed"><i
                                class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                <?php }
            }
            ?>
        </tbody>
    </table> <br>
    <?php
    } else { ?>
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true"
        data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th>Archivo</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directorio = opendir("../Formatos/"); //ruta actual
            while ($archivo = readdir($directorio)){ //obtenemos un archivo y luego otro sucesivamente
                if ($archivo != "." && $archivo !="..") { ?>
                <tr>
                    <td> <i class="fa fa-file-excel-o text-success"></i> &nbsp;<?php echo $archivo ?></td>
                    <td>
                        <a title="Descargar" class="pd-setting-ed external" href="Descarga.php?Archivo=<?php echo $archivo; ?>">
                            <i class="fa fa-cloud-download edu-check-icon" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <?php }
            }
            ?>
        </tbody>
    </table> <br>
<?php
    }
?>

<!-- data table JS
	============================================ -->
<script src="../js/tablas.js"></script>