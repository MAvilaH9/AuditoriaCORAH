<?php
    session_start();
	include("Conexion.php");

	if(isset($_POST["IdAuditar"]))
	{
		$Id=$_POST['IdAuditar'];
		$output = array();
		$statement = $pdo->prepare(
			"SELECT * from CalendarioAuditar
			WHERE IdCalendarioAuditar = '$Id'"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output["IdCalendarioAuditar"] = $row["IdCalendarioAuditar"];
			$output["Sucursal"] = $row["Sucursal"];
			$output["Almacen"] = $row["Almacen"];
			$output["Auditor"] = $row["Usuario"];
			$output["Fecha"] = $row["Fecha"];
		}
		echo json_encode($output);
	}
?>