<?php
    require_once "../ClasesExcel/PHPExcel.php";

    $Archivo = $_REQUEST["Archivo"];

    $ruta = "C:\xampp\htdocs\AuditoriaCORAH\Excel/".$Archivo;

    header('Content-Disposition: attachment; filename='.$Archivo);
    
    header('Content-Type: application/vnd.ms-excel');
        
    header('Content-Length:'.filesize($ruta));

    header('Cache-Control: max-age=0');

    readfile($ruta);
    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    $objWriter->save('php://output');

    exit;

?>