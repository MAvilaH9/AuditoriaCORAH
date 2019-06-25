<?php
    require_once "Conexion.php";
    require_once "../ClasesExcel/PHPExcel/IOFactory.php";

    if (isset($_POST['operacion'])) {
        if ($_POST['operacion'] == "Agregar") {
            // print_r ($_FILES);
            $archivo=$_FILES['excel']['name'];
            $destino="../Excel/".$archivo;

            if (copy($_FILES['excel']['tmp_name'],$destino)) {

                if (file_exists("../Excel/".$archivo)) {
                    
                    $objPHPExcel = PHPExcel_IOFactory::load("../Excel/".$archivo);
        
                    $objPHPExcel->setActiveSheetIndex(0);
            
                    $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); ?>
                    
                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true"
                        data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                        <tr>
                            <th>Nombre (s)</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Usuario</th>
                            <th>Contrasenia</th>
                            <th>ClaveEmpresa</th>
                            <th>IdPerfil</th>
                        </tr>
                    <?php
            
                    for ($i=2; $i <= $numfilas ; $i++) { 

                        $nombre = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                        $apat = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                        $amat = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                        $us = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                        $contra = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                        $emp = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                        $per = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
                        ?>
                        <tr>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $apat; ?></td>
                            <td><?php echo $amat; ?></td>
                            <td><?php echo $us ;?></td>
                            <td><?php echo $contra; ?></td>
                            <td><?php echo $emp; ?></td>
                            <td><?php echo $per; ?></td>
                        </tr>
                    <?php
                    } ?>
                    </table>  

                    <?php
                }
            } else {
                echo "Error Al Cargar el Archivo";
            } 

            ?>

            <!-- data table JS
            ============================================ -->
            <script src="../js/tablas.js"></script>
            
        <?php
        }

        if ($_POST['operacion'] == "Guardar") {
            // print_r ($_FILES);
            $archivo=$_FILES['excel']['name'];
            $destino="../Excel/".$archivo;

            if (file_exists("../Excel/".$archivo)) {
                $objPHPExcel = PHPExcel_IOFactory::load("../Excel/".$archivo);

                $objPHPExcel->setActiveSheetIndex(0);
    
                $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    
                for ($i=2; $i <= $numfilas ; $i++) { 

                    $nombre = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                    $apat = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                    $amat = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                    $us = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                    $contra = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                    $emp = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                    $per = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();

                    $sql_agregar = "INSERT INTO usuario (Nombres, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasenia, ClaveEmpresa, IdPerfil) 
                    VALUE ('$nombre','$apat','$amat','$us','$contra','$emp','$per')";
                    $sentencia_agregar = $pdo->prepare($sql_agregar);
                    $sentencia_agregar->execute(array($sql_agregar));

                }

                if ($sentencia_agregar->execute(array($nombre, $apat, $amat, $us, $contra, $emp, $per))) { ?>
                    <script>
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Datos Guardados',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('document.location.reload()',1000);
                    </script>
                <?php   
                } else { 
                ?>
                    <script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error al guardar los datos',
                            type: 'error',
                            confirmButtonText: 'Cool'
                        })
                        setTimeout('document.location.reload()',1000);
                    </script>
                <?php                 
                }
            } else { ?>
                <script>
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Error en el proceso!',
                    })
                    setTimeout('document.location.reload()',1000);
                </script>
            <?php
            }
        }
    }
?>