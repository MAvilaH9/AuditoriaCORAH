<?php
    session_start();
    include "Conexion.php";

    $id=$_POST["id"];

    $sql = "DELETE FROM usuario WHERE IdUsuario=$id";
    $result = $pdo->prepare($sql);
    if ($result->execute([':IdUsuario' => $id])) {
        echo 1;
    }

?>