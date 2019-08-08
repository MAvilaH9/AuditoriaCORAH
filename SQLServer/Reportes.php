<?php 
    session_start();
    $usuario = $_SESSION['Usuario'];
    $Empresa=$_SESSION['NombreEmpresa'];
    $fecha = date("d-m-Y");
    $año=date('Y');

    // print_r($_FILES);
    $Archivo = $usuario."_".$fecha;
    $NombreArchivo=$Archivo."_".$_FILES['Archivo']['name'];
    $Guardado = $_FILES['Archivo']['tmp_name'];
    $directorio = '../Reportes/'.$Empresa.'/'.$año.'/'.$NombreArchivo;
    
    if (!file_exists($directorio)) {
        if (!file_exists('../Reportes/'.$Empresa.'/'.$año)) {
            mkdir('../Reportes/'.$Empresa.'/'.$año,0777,true);
            if (file_exists('../Reportes/'.$Empresa.'/'.$año)) {
                if (move_uploaded_file($Guardado,'../Reportes/'.$Empresa.'/'.$año.'/'.$NombreArchivo)) {
                    echo 1;
                }else {
                    echo 2;
                }
            }
        }else {
            if (move_uploaded_file($Guardado,'../Reportes/'.$Empresa.'/'.$año.'/'.$NombreArchivo)) {
                echo 1;
            }else {
                echo 2;
            }
        }
    }else {
        echo 3;
    }
?>