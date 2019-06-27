<?php 
    session_start();
    $usuario = $_SESSION['Usuario'];

    // print_r($_FILES);
    $Nombre = $usuario."_".$_FILES['Archivo']['name'];
    $Guardado = $_FILES['Archivo']['tmp_name'];
    $directorio = '../Excel/'.$Nombre;
    
    if (!file_exists($directorio)) {
        if (!file_exists('../Excel')) {
            mkdir('Excel',0777,true);
            if (file_exists('../Excel')) {
                if (move_uploaded_file($Guardado,'../Excel/'.$Nombre)) {
                    echo 1;
                }else {
                    echo 2;
                }
            }
        }else {
            if (move_uploaded_file($Guardado,'../Excel/'.$Nombre)) {
                echo 1;
            }else {
                echo 2;
            }
        }
    }else {
        echo 3;
    }
?>