<?php
    session_start();
    require_once ("Conexion.php");
    require_once "../ClasesExcel/PHPExcel.php";
    $us=$_SESSION['Usuario'];
    $fecha= date("d/m/Y");

    //Articulos Sucursal

    if (isset($_GET['Sucursal'])) {

        $fecha= date("d/m/Y");
        $Sucursal=$_GET['Sucursal'];

        $sqlsuc = $pdo->prepare("SELECT Nombre FROM Sucursal where Sucursal=$Sucursal");
        $sqlsuc -> execute(array($Sucursal));
        $resultadosuc = $sqlsuc->fetch();
        $NombSuc=$resultadosuc['Nombre'];

        $objPHPExcel = new PHPExcel();

        //Informacion del excel
        $objPHPExcel->getProperties()
            ->setCreator("Auditoria CORAH")
            ->setLastModifiedBy("Auditoria")
            ->setTitle("Office 2010 XLSX Documento de Reporte")
            ->setSubject("Office 2010 XLSX Documento de Reporte")
             ->setDescription("Documento de listado de articulos de sucursal"."$NombSuc")
            ->setKeywords("office 2010")
            ->setCategory("Consultas");    

            // Titulos de celdas
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Articulo')
            ->setCellValue('B1', 'Descripción')
            ->setCellValue('C1', 'Precio Lista')
            ->setCellValue('D1', 'Stock')
            ->setCellValue('E1', 'Cant. Piso')
            ->setCellValue('F1', 'Cant. Bodega')
            ->setCellValue('G1', 'Diferencias');
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);	
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);	

        // Fuente de la primera fila en negrita
        $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
        
        // Aplicar el formato
        $rango='A1:G1';
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

        // Cambiar el nombre de hoja de cálculo
        $objPHPExcel->getActiveSheet()->setTitle('Articulos');

        
        $sql= $pdo->prepare("SELECT * FROM Articulo WHERE Sucursal='$Sucursal' ORDER BY Articulo ASC");
        $sql->execute();

        $i = 2;  
        while ($fila = $sql->fetch()) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $fila['Articulo'])
                ->setCellValue('B'.$i, $fila['Descripcion1'])
                ->setCellValue('C'.$i, $fila['PrecioLista']);
            $i++;
        }
            

        // Establecer activa a la primera hoja , 
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Ventas_'.$NombSuc.'_'.$fecha.'_'.$us.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');
        exit;
                
    }

    //Articulos Almacen

    
    if (isset($_GET['Almacen']) && isset($_GET['Articuloi']) && isset($_GET['Articulof'])){

        if (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) 
        && isset($_GET['Familia']) && isset($_GET['Grupo']) && isset($_GET['Proveedor']) 
        && isset($_GET['Fabricante']) && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    

                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {
                $Stock=$fila['Disponible'] + $fila['Reservado'];

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) 
        && isset($_GET['Familia']) && isset($_GET['Grupo']) && isset($_GET['Proveedor']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];
        
            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    

                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) 
        && isset($_GET['Familia']) && isset($_GET['Grupo']) && isset($_GET['Articuloi']) 
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) 
        && isset($_GET['Familia']) && isset($_GET['Articuloi']) 
        && isset($_GET['Articulof'])) {


            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];
        
            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Familia']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Familia=$_GET['Familia'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Familia='$Familia'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Grupo']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Grupo=$_GET['Grupo'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Grupo='$Grupo'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Proveedor']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Proveedor='$Proveedor'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Fabricante']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');
            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Familia']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Familia='$Familia'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Grupo']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Grupo=$_GET['Grupo'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Grupo='$Grupo'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Proveedor']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Proveedor='$Proveedor'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Fabricante']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                      
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Grupo']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                  
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Grupo='$Grupo'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Proveedor']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                  
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantida Venta');

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Proveedor='$Proveedor'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Fabricante']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                              
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo']) && isset($_GET['Proveedor']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                              
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Proveedor='$Proveedor'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo']) && isset($_GET['Fabricante']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                                          
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Proveedor']) && isset($_GET['Fabricante']) 
        && isset($_GET['Articuloi']) && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Proveedor=$_GET['Proveedor'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                                                      
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Categoria.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                                                                                  
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Rama.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
                                                                                  
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Familia.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Grupo.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Proveedor']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Proveedor=$_GET['Proveedor'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Proveedor.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Fabricante']) && isset($_GET['Articuloi'])
        && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Fabricante=$_GET['Fabricante'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
                        
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Fabricante='$Fabricante'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Fabricante.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif  (isset($_GET['Almacen']) && isset($_GET['Articuloi'])  && isset($_GET['Articulof'])) {

            $Almacen=$_GET['Almacen'];
            $Articuloi=$_GET['Articuloi'];
            $Articulof=$_GET['Articulof'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];
        
            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
            AND Articulo BETWEEN '$Articuloi' AND '$Articulof' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {
                
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        }

    } 
    if (isset($_GET['Almacen'])) {

        if (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) && isset($_GET['Familia']) 
        && isset($_GET['Grupo']) && isset($_GET['Proveedor']) && isset($_GET['Fabricante'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante'
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) && isset($_GET['Familia']) 
        && isset($_GET['Grupo']) && isset($_GET['Proveedor'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) && isset($_GET['Familia'])
        && isset($_GET['Grupo'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);		

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND Grupo='$Grupo' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
            ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama']) && isset($_GET['Familia'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama'
            AND Familia='$Familia' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Rama'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Rama=$_GET['Rama'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND ArtRama='$Rama' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Familia'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Familia=$_GET['Familia'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Familia='$Familia' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Grupo'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Grupo=$_GET['Grupo'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Grupo='$Grupo' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Proveedor'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria']) && isset($_GET['Fabricante'])) {
                
            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' AND Fabricante='$Fabricante' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Familia'])) {
        
            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Familia=$_GET['Familia'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Familia='$Familia' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Grupo'])) {
        
            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Grupo=$_GET['Grupo'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Grupo='$Grupo' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Proveedor'])) {
        
            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        
        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama']) && isset($_GET['Fabricante'])) {
                
            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' AND Fabricante='$Fabricante' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        
        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Grupo'])) {
        
            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Grupo=$_GET['Grupo'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Grupo='$Grupo' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Proveedor'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia']) && isset($_GET['Fabricante'])) {

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' AND Fabricante='$Fabricante' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo']) && isset($_GET['Proveedor'])) {
                
            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo']) && isset($_GET['Fabricante'])) {
            
            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];
            
            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' AND Fabricante='$Fabricante' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        
        } elseif (isset($_GET['Almacen']) && isset($_GET['Proveedor']) && isset($_GET['Fabricante'])) {

            $Almacen=$_GET['Almacen'];
            $Proveedor=$_GET['Proveedor'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' AND Fabricante='$Fabricante' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Categoria'])){

            $Almacen=$_GET['Almacen'];
            $Categoria=$_GET['Categoria'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtCategoria='$Categoria' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Categoria.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;

        } elseif (isset($_GET['Almacen']) && isset($_GET['Rama'])){

            $Almacen=$_GET['Almacen'];
            $Rama=$_GET['Rama'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND ArtRama='$Rama' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Rama.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen']) && isset($_GET['Familia'])){

            $Almacen=$_GET['Almacen'];
            $Familia=$_GET['Familia'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Familia='$Familia' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Familia.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen']) && isset($_GET['Grupo'])){

            $Almacen=$_GET['Almacen'];
            $Grupo=$_GET['Grupo'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Grupo='$Grupo' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Grupo.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen']) && isset($_GET['Proveedor'])){

            $Almacen=$_GET['Almacen'];
            $Proveedor=$_GET['Proveedor'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' AND Proveedor='$Proveedor' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Proveedor.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen']) && isset($_GET['Fabricante'])){

            $Almacen=$_GET['Almacen'];
            $Fabricante=$_GET['Fabricante'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];

            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX 
            WHERE Almacen='$Almacen' AND Fabricante='$Fabricante' AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal'
            ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$Fabricante.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        } elseif (isset($_GET['Almacen'])){

            $Almacen=$_GET['Almacen'];
            $FechaInicio=$_GET['FechaInicio'];
            $FechaFinal=$_GET['FechaFinal'];

            $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
            $sqlAlm -> execute(array($Almacen));
            $resultadoAlm = $sqlAlm->fetch();
            $NombAlm=$resultadoAlm['Nombre'];
        
            $objPHPExcel = new PHPExcel();

            //Informacion del excel
            $objPHPExcel->getProperties()
                ->setCreator("Auditoria CORAH")
                ->setLastModifiedBy("Auditoria")
                ->setTitle("Office 2010 XLSX Documento de Reporte")
                ->setSubject("Office 2010 XLSX Documento de Reporte")
                ->setDescription("Documento de listado de articulos de sucursal"."$NombAlm")
                ->setKeywords("office 2010")
                ->setCategory("Consultas");    


                // Titulos de celdas
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Articulo')
                ->setCellValue('B1', 'Descripción')
                ->setCellValue('C1', 'Cantidad Venta');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);	
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);


            // Fuente de la primera fila en negrita
            $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
            
            // Aplicar el formato
            $rango='A1:G1';
            $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($boldArray);

            // Cambiar el nombre de hoja de cálculo
            $objPHPExcel->getActiveSheet()->setTitle('Ventas');

            
            $sqla = $pdo->prepare("SELECT Articulo, Descripcion1, CONVERT(numeric(10,0), CantidadX) CantidadX 
            FROM Corah_VentaUtilX WHERE Almacen='$Almacen' 
            AND FechaEmision BETWEEN '$FechaInicio' AND '$FechaFinal' ORDER BY Articulo ASC");
            $sqla->execute();

            $i = 2;  
            while ($fila = $sqla->fetch()) {

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $fila['Articulo'])
                    ->setCellValue('B'.$i, $fila['Descripcion1'])
                    ->setCellValue('C'.$i, $fila['CantidadX']);
                $i++;
            }
                

            // Establecer activa a la primera hoja , 
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Ventas_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save('php://output');
            exit;
        }
    }

?>