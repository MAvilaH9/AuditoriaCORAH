<?php
    session_start();
    include "Conexion.php";

    $IdAuditar=$_POST["IdAuditar"];

    $sql = "DELETE FROM auditar WHERE IdAuditar=$IdAuditar";
    $result = $pdo->prepare($sql);
    if ($result->execute([':IdAuditar' => $IdAuditar])) {
        echo 1;
    }

?>