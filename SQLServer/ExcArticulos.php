<?php
    session_start();
    require_once ("Conexion.php");
    require_once "../ClasesExcel/PHPExcel.php";
    $us=$_SESSION['Usuario'];

    //Articulos Sucursal

    if (isset($_GET['Sucursal'])) {

        $fecha= date("d/m/Y");
        $Sucursal=$_GET['Sucursal'];

        $sqlsuc = $pdo->prepare("SELECT Nombre FROM Sucursal where Sucursal=$Sucursal");
        $sqlsuc -> execute(array($Sucursal));
        $resultadosuc = $sqlsuc->fetch();
        $NombSuc=$resultadosuc['Nombre'];
        
        // header('Content-type:application/xls');
        // header("Content-Disposition:attachment; filename= Articulos_".$NombSuc."_".$fecha."_".$us.".xls");

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
            ->setCellValue('F1', 'Cant. Piso')
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
        header('Content-Disposition: attachment;filename="Articulos_'.$NombSuc.'_'.$fecha.'_'.$us.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');
        exit;
                
    }

    //Articulos Almacen

    if (isset($_GET['Almacen'])){

        $fecha= date("d/m/Y");
        $Almacen=$_GET['Almacen'];

        $sqlAlm = $pdo->prepare("SELECT Nombre FROM Alm where Almacen='$Almacen'");
        $sqlAlm -> execute(array($Almacen));
        $resultadoAlm = $sqlAlm->fetch();
        $NombAlm=$resultadoAlm['Nombre'];

        // header('Content-type:application/xls');
        // header("Content-Disposition:attachment; filename= Articulos_".$NombAlm."_".$fecha.".xls");
    
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
            ->setCellValue('C1', 'Precio Lista')
            ->setCellValue('D1', 'Stock')
            ->setCellValue('E1', 'Cant. Piso')
            ->setCellValue('F1', 'Cant. Piso')
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

        
        $sqla = $pdo->prepare("SELECT a.Articulo, a.Descripcion1, a.PrecioLista FROM Art a INNER JOIN ArtAlm al ON 
        a.Articulo=al.Articulo WHERE al.Almacen='$Almacen' ORDER BY Articulo ASC");
        $sqla->execute();

        $i = 2;  
        while ($fila = $sqla->fetch()) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $fila['Articulo'])
                ->setCellValue('B'.$i, $fila['Descripcion1'])
                ->setCellValue('C'.$i, $fila['PrecioLista']);
            $i++;
        }
            

        // Establecer activa a la primera hoja , 
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Articulos_'.$NombAlm.'_'.$fecha.'_'.$us.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
?>