<?php
    session_start();
    require_once "Conexion.php";
    require_once "../ClasesExcel/PHPExcel/IOFactory.php";
    $usuario = $_SESSION['Usuario'];            
    $Almacen=$_POST['Almacen'];
    date_default_timezone_set('America/Mexico_City');
    $FechaActual = date("d-m-Y H:i:s:v",time());
    $ArcEmpresa=$_SESSION['Empresa'];
  

    if (isset($_POST['operacion'])) {
        if ($_POST['operacion'] == "Agregar") {

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            // print_r ($_FILES);
            $archivo= $usuario."_"."$NombAlm"."_".$_FILES['excel']['name'];
            $Guardado=$_FILES['excel']['tmp_name'];
            $destino='../Ajustes/'.$ArcEmpresa.'/'.$archivo;
            
            if (!file_exists($destino)) {
                if (!file_exists('../Ajustes/'.$ArcEmpresa)) {
                    mkdir('../Ajustes/'.$ArcEmpresa,0777,true);
                    if (file_exists('../Ajustes/'.$ArcEmpresa)) {
                        if (move_uploaded_file($Guardado,'../Ajustes/'.$ArcEmpresa.'/'.$archivo)) {
    
                            if (file_exists('../Ajustes/'.$ArcEmpresa.'/'.$archivo)) {
                                
                                $objPHPExcel = PHPExcel_IOFactory::load('../Ajustes/'.$ArcEmpresa.'/'.$archivo);
                    
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
                                <script>
                                    Swal.fire({
                                        title: 'Advertencia!',
                                        text: 'Valide la información antes de guardar',
                                        type: 'warning',
                                        confirmButtonText: 'Aceptar'
                                    })
                                </script>
                                
                                <?php
                                $_SESSION['Archivo'] = $archivo;
                                // $data= array();
                                // $data['Archivo']= $archivo;
                                // echo json_encode($data);
                            }
                        } else { ?>
                            <script>
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Error al cargar archivo',
                                    type: 'error',
                                    confirmButtonText: 'Aceptar'
                                })
                                setTimeout('document.location.reload()',1000);
                            </script>
                        <?php
                        } 
                        ?>
            
                        <!-- data table JS
                        ============================================ -->
                        <script src="../js/tablas.js"></script>
                        
                    <?php
                    } else { ?>
                        <script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error al cargar archivo',
                            type: 'error',
                            confirmButtonText: 'Aceptar'
                        })
                        setTimeout('document.location.reload()',1000);
                    </script>
                    <?php 
                    }
                } else{

                    if (move_uploaded_file($Guardado,'../Ajustes/'.$ArcEmpresa.'/'.$archivo)) {
    
                        if (file_exists('../Ajustes/'.$ArcEmpresa.'/'.$archivo)) {
                            
                            $objPHPExcel = PHPExcel_IOFactory::load('../Ajustes/'.$ArcEmpresa.'/'.$archivo);
                
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
                            <script>
                                Swal.fire({
                                    title: 'Advertencia!',
                                    text: 'Valide la información antes de guardar',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar'
                                })
                            </script>
                            
                            <?php
                            $_SESSION['Archivo'] = $archivo;
                            // $data= array();
                            // $data['Archivo']= $archivo;
                            // echo json_encode($data);
                        }
                    } else { ?>
                        <script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error al cargar archivo',
                                type: 'error',
                                confirmButtonText: 'Aceptar'
                            })
                            setTimeout('document.location.reload()',1000);
                        </script>
                    <?php
                    } 
                    ?>
        
                    <!-- data table JS
                    ============================================ -->
                    <script src="../js/tablas.js"></script>
                    
                <?php
                }
                
            } else { ?>
                <script>
                     Swal.fire({
                         title: 'Error!',
                        text: 'Error al cargar archivo',
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                    setTimeout('document.location.reload()',1000);
                </script>
            <?php 
            }

        }

        if ($_POST['operacion'] == "Guardar") {
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            // print_r ($_FILES);            
            $archivo=$usuario."_"."$NombAlm"."_".$_FILES['excel']['name'];

            if (file_exists('../Ajustes/'.$ArcEmpresa.'/'.$archivo)) {

                $Empresa="VAL";
                $Moneda="Pesos";
                $Estatus="CONCLUIDO";
                $Movimiento=$_POST['Movimiento'];
                $FechaEmision=$_POST['FechaEmision'];
                $Concepto=$_POST['Concepto'];
                $Referencia=$_POST['Referencia'];
                $Observacion=$_POST['Observacion'];
                $renglon=2048;
    
                $sqlAgregarMOv = "INSERT INTO Inv (Empresa, Mov, FechaEmision, UltimoCambio, Concepto, Moneda, Usuario, 
                Referencia, Observaciones, Estatus, Almacen) 
                VALUES ('$Empresa','$Movimiento','$FechaEmision','$FechaActual','$Concepto','$Moneda','$usuario','$Referencia',
                '$Observacion','$Estatus','$Almacen')";
                $sentencia = $pdo->prepare($sqlAgregarMOv);
                $sentencia->execute(array($sqlAgregarMOv));
                $IdInv = $pdo->lastInsertId();

                $objPHPExcel = PHPExcel_IOFactory::load('../Ajustes/'.$ArcEmpresa.'/'.$archivo);

                $objPHPExcel->setActiveSheetIndex(0);
    
                $numfilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

                // $rango;
                // $rangoCell = $objPHPExcel->getActiveSheet()->rangeToArray($rango);
    
                for ($i=2; $i <= $numfilas; $i++) { 
                    
                    $Articulo = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                    $Cantidad = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
                    $Unidad = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
                    $Inventario = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
                    $Paquete = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
                    $CostoU = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
                    $CostoT = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();


                    $Renglon = (2048 * $i) - 2048;
                    $RenglonID= $i -1 ;

                    $sql_agregar = "INSERT INTO InvD (ID, Renglon, RenglonID, Cantidad, Almacen, Articulo, Costo, Unidad, 
                    CantidadInventario) 
                    VALUES ('$IdInv','$Renglon','$RenglonID','$Cantidad','$Almacen','$Articulo','$CostoU','$Unidad',
                    '$Inventario')";
                    $sentencia_agregar = $pdo->prepare($sql_agregar);
                    $sentencia_agregar->execute(array($sql_agregar));
                } 


                if ($sentencia == true && $sentencia_agregar == true) { ?>
                    <!-- Alerta exito -->
                    <script>
                        Swal.fire({
                            title: 'Datos Guardados',
                            text: 'Datos guardados con exito.',
                            type: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.value) {
                                setTimeout('document.location.reload()',1);
                            }
                        })
                    </script>
                <?php   
                } else { 
                ?>  
                <!-- Alerta error -->
                    <script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error al guardar los datos',
                            type: 'error',
                            confirmButtonText: 'Aceptar'
                        })
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
                    setTimeout('document.location.reload()',100000);
                </script>
            <?php
            }
        }
    }
?>
