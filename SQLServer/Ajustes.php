<?php
    session_start();
    require_once "Conexion.php";
    require_once "../ClasesExcel/PHPExcel/IOFactory.php";
    $usuario = $_SESSION['Usuario'];

    if (isset($_POST['operacion'])) {
        if ($_POST['operacion'] == "Agregar") {

            $fecha= date("d/m/Y");
            $Almacen=$_POST['Almacen'];
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            // print_r ($_FILES);
            $archivo= $usuario."_"."$NombAlm"."_".$_FILES['excel']['name'];
            $destino="../Excel/".$archivo;

            if (copy($_FILES['excel']['tmp_name'],$destino)) {

                if (file_exists("../Excel/".$archivo)) {
                    
                    $objPHPExcel = PHPExcel_IOFactory::load("../Excel/".$archivo);
        
                    $objPHPExcel->setActiveSheetIndex(0);
            
                    $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); ?>
                    
                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-key-events="true" data-cookie="true"
                        data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                        <tr>
                            <th>Articulo</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Inventario</th>
                            <th>Paquete</th>
                            <th>Costo unitario</th>
                            <th>Costo Total</th>
                        </tr>
                    <?php
            
                    for ($i=2; $i <= $numfilas ; $i++) { 

                        $Articulo = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                        $Cantidad = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                        $Unidad = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                        $Inventario = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                        $Paquete = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                        $CostoU = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                        $CostoT = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
                        ?>
                        <tr>
                            <td><?php echo $Articulo; ?></td>
                            <td><?php echo $Cantidad; ?></td>
                            <td><?php echo $Unidad; ?></td>
                            <td><?php echo $Inventario ;?></td>
                            <td><?php echo $Paquete; ?></td>
                            <td><?php echo $CostoU; ?></td>
                            <td><?php echo $CostoT; ?></td>
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
            $archivo=$usuario."_".$_FILES['excel']['name'];

            if (file_exists("../Excel/".$archivo)) {

                $objPHPExcel = PHPExcel_IOFactory::load("../Excel/".$archivo);

                $objPHPExcel->setActiveSheetIndex(0);
    
                $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

                // $rango;
                // $rangoCell = $objPHPExcel->getActiveSheet()->rangeToArray($rango);
    
                for ($i=2; $i <= $numfilas ; $i++) { 
                    
                    $Articulo = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                    $Cantidad = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                    $Unidad = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                    $Inventario = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                    $Paquete = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                    $CostoU = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                    $CostoT = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();

                    $sql_agregar = "INSERT INTO Usuario (Nombres, ApellidoPaterno, ApellidoMaterno, Usuario, Contrasenia, ClaveEmpresa, IdPerfil) 
                    VALUES ('$nombre','$apat','$amat','$us','$contra','$emp','$per')";
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
