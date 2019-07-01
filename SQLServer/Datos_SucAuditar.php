<?php
    session_start();
	include("Conexion.php");

	if(isset($_POST["IdAuditar"]))
	{
		$Id=$_POST['IdAuditar'];
		$output = array();
		$statement = $pdo->prepare(
			"SELECT * FROM Auditar 
			WHERE IdAuditar = $Id"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output["IdAuditar"] = $row["IdAuditar"];
			$output["ClaveEmpresa"] = $row["ClaveEmpresa"];
			$output["Sucursal"] = $row["Sucursal"];
			$output["Almacen"] = $row["Almacen"];
			$output["IdUsuario"] = $row["IdUsuario"];
			$output["Fecha"] = $row["Fecha"];
		}
		echo json_encode($output);
	}
?>