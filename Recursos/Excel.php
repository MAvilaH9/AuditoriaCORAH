<?php 

    // print_r($_FILES);
    $Nombre=$_FILES['Archivo']['name'];
    $Guardado=$_FILES['Archivo']['tmp_name'];

    if (!file_exists('../Excel/'.$Nombre)) {
        mkdir('Excel',0777,true);
        if (file_exists('../Excel')) {
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