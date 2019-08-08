<?php
    session_start();
    $Empresa=$_SESSION['NombreEmpresa'];
    // Descraga
    if (!empty($_REQUEST['Archivo'])) {
        
        $año=$_GET['Año'];
        $Archivo = $_REQUEST["Archivo"];

        $ruta = '../Reportes/'.$Empresa.'/'.$año.'/'.$Archivo;
    
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
        $ruta = '../Reportes/'.$Empresa.'/'.$anio.'/'.$Archivo;
        unlink($ruta);
        echo 1;
        exit;
    }

    // Elimina archivo al cancelar proceso antes de guardar info en la bd
    
    // if (!empty($_REQUEST['Cancelar'])) {
    //     $Archivo = $_SESSION["Archivo"];
    //     $ruta = '../Reportes/'.$Empresa.'/'.$Archivo;
    //     unlink($ruta);
    //     unset($_SESSION['Archivo']);
    //     header("Location: Ajustes.php");
    //     exit;
    // }

    // if (!empty($_REQUEST['Cancelar2'])) {
    //     $Archivo = $_SESSION["Archivo"];
    //     $ruta = '../Reportes/'.$Empresa.'/'.$Archivo;
    //     unlink($ruta);
    //     unset($_SESSION['Archivo']);
    //     header("Location: Index.php");
    //     exit;
    // }
?>