
<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

    require_once "../SQLServer/Conexion.php";
    $fecha= date("d/m/Y");
    $Sucursal=$_GET['Sucursal'];
    $us=$_SESSION['Usuario'];

    $sqlsuc = $pdo->prepare("SELECT Nombre FROM Sucursal where Sucursal=$Sucursal");
    $sqlsuc -> execute(array($Sucursal));
    $resultadosuc = $sqlsuc->fetch();
    $NombSuc=$resultadosuc['Nombre'];

    $sql= $pdo->prepare("SELECT * FROM Articulo WHERE Sucursal='$Sucursal' ORDER BY Articulo ASC");
    $sql->execute(array(':kind' => 'drupe'));

 if ($resultado > 0) {
   require_once '../ClasesExcel/PHPExcel.php';
   $objPHPExcel = new PHPExcel();

   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("lahuerta")
        ->setLastModifiedBy("lahuerta")
        ->setTitle("Exportar Base de Datos")
        ->setSubject("Tabla")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("lahuerta  con  phpexcel")
        ->setCategory("solicitudes");    

   $i = 1;    
   while ($registro = $sql->fetch(PDO::FETCH_ASSOC)) {

      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro->name);

      $i++;

   }
}
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="tabla.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    $objWriter->save('php://output');
    exit;
    mysql_close ();
?>