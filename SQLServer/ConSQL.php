<?php
    include "Conexion.php";

    $query = 'SELECT * from Perfil';  
  
    $stmt = $conn->query( $query );  
    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){  
       echo $row['DescripcionPerfil'];
    }  
      

?>