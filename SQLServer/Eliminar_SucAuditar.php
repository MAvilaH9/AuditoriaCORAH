<?php
    session_start();
    include_once "Conexion.php";

    $IdAuditar=$_POST["IdAuditar"];

    $sql = "DELETE FROM Auditar WHERE IdAuditar=$IdAuditar";
    $params = array($_POST['IdAuditar']);
    $result = $pdo->prepare($sql);
    if ($result->execute($params)) {
        echo 1;
    }


?>