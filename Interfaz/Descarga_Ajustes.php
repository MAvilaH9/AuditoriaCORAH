<?php
    session_start();
    $Empresa=$_SESSION['NombreEmpresa'];
    
    // Descraga
    if (!empty($_REQUEST['Archivo'])) {
        
        $Archivo = $_REQUEST["Archivo"];
        $año=$_GET['Año'];
        $ruta = '../Ajustes/'.$Empresa.'/'.$año.'/'.$Archivo;
    
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

    // Elimina
    if (!empty($_REQUEST['id'] && $_REQUEST['anio'])) {
        $anio = $_REQUEST["anio"];
        $Archivo = $_REQUEST["id"];
        $ruta = '../Ajustes/'.$Empresa.'/'.$anio.'/'.$Archivo;
        unlink($ruta);
        echo 1;
        exit;
    }

    // Elimina archivo al cancelar proceso antes de guardar info en la bd
    
    $año=date("Y");
    if (!empty($_REQUEST['Cancelar'])) {
        $Archivo = $_SESSION["Archivo"];
        $ruta = '../Ajustes/'.$Empresa.'/'.$año.'/'.$Archivo;
        unlink($ruta);
        unset($_SESSION['Archivo']);
        header("Location: Ajustes.php");
        exit;
    }

    if (!empty($_REQUEST['Cancelar2'])) {
        $Archivo = $_SESSION["Archivo"];
        $ruta = '../Ajustes/'.$Empresa.'/'.$año.'/'.$Archivo;
        unlink($ruta);
        unset($_SESSION['Archivo']);
        header("Location: Index.php");
        exit;
    }
?>