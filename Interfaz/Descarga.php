<?php
    if (!empty($_REQUEST['Archivo'])) {
        
        $Archivo = $_REQUEST["Archivo"];

        $ruta = "../Excel/".$Archivo;
    
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$Archivo");
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Transfer-Encoding: binary");
            
        // Read the file
        readfile($ruta);
        exit;
    }
?>