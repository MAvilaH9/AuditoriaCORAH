<?php
    // session_start();
	require_once "Conexion.php";

	if(isset($_POST["idUsuario"]))
	{
		$id=$_POST['idUsuario'];
		$output = array();
		$sql=$pdo->prepare(
			"SELECT * FROM Usuario 
			WHERE Usuario = '$id'"
		);
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{
			// $output["ApellidoPaterno"] = $row["ApellidoPaterno"];
			// $output["ApellidoMaterno"] = $row["ApellidoMaterno"];
			$output["Nombre"] = $row["Nombre"];
			$output["Usuario"] = $row["Usuario"];
			$output["Contrasena"] = $row["Contrasena"];
			$output["Departamento"] = $row["Departamento"];
			$output["Acceso"] = $row["Acceso"];
		}
		echo json_encode($output);
	}
?>