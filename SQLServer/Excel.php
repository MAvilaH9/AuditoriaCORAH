<?php 
    session_start();
    $usuario = $_SESSION['Usuario'];
    $Empresa=$_SESSION['Empresa'];

    // print_r($_FILES);
    $Nombre = $usuario."_".$_FILES['Archivo']['name'];
    $Guardado = $_FILES['Archivo']['tmp_name'];
    $directorio = '../Reportes/'.$Empresa.'/'.$Nombre;
    
    if (!file_exists($directorio)) {
        if (!file_exists('../Reportes/'.$Empresa)) {
            mkdir('../Reportes/'.$Empresa,0777,true);
            if (file_exists('../Reportes/'.$Empresa)) {
                if (move_uploaded_file($Guardado,'../Reportes/'.$Empresa.'/'.$Nombre)) {
                    echo 1;
                }else {
                    echo 2;
                }
            }
        }else {
            if (move_uploaded_file($Guardado,'../Reportes/'.$Empresa.'/'.$Nombre)) {
                echo 1;
            }else {
                echo 2;
            }
        }
    }else {
        echo 3;
    }
?>