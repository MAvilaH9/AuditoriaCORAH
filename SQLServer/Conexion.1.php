<?php
// Conexion Normal

// $serverName = "MAVILAHU\SQLEXPRESS"; //serverName\instanceName, portNumber (por defecto es 1433)
// $connectionInfo = array( "Database"=>"Generador");
// $conn = sqlsrv_connect($serverName, $connectionInfo);

// if( $conn ) {
//      echo "Conexión establecida.<br />";


// }else{
//      echo "Conexión no se pudo establecer.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }

// Conexion PDO

	$server = 'MAVILAHU\SQLEXPRESS';
	$dbName = 'Auditoria';
	$uid = '';
	$pwd = '';

	try{
		
		$pdo = new PDO("sqlsrv:server=$server; database = $dbName", $uid, $pwd);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	}catch (PDOException $e) {

		print "¡Error!: " . $e->getMessage() . "<br/>";
		die($e -> getMessage());
	}  
?>