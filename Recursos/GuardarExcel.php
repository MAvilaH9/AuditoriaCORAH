<?php
    require_once "Conexion.php";
    require_once "../ClasesExcel/PHPExcel/IOFactory.php";

    if (isset($_POST['operacion'])) {
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
                    
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        </div>
    
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div id="AlertExito" class="alert alert-success" role="alert"
                                style="display:none">
                                <strong>Exitoso!</strong> Archivo guardados con exito
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        </div>
                <?php   
                } else { 
                ?>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        </div>
    
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div id="AlertError" class="alert alert-danger alert-mg-b"
                                style="display:none">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Error!</strong> Archivo no guardado.
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        </div>
                <?php                 
                }
            } else {
                echo 3;
            }
        }
    }
?>