<?php
    // session_start();
	require_once "Conexion.php";

	if(isset($_POST["idUsuario"]))
	{
		$id=$_POST['idUsuario'];
		$output = array();
		$sql=$pdo->prepare(
			"SELECT * FROM Usuario 
			WHERE IdUsuario = '$id'"
		);
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{
			$output["ApellidoPaterno"] = $row["ApellidoPaterno"];
			$output["ApellidoMaterno"] = $row["ApellidoMaterno"];
			$output["Nombres"] = $row["Nombres"];
			$output["Usuario"] = $row["Usuario"];
			$output["Contrasenia"] = $row["Contrasenia"];
			$output["ClaveEmpresa"] = $row["ClaveEmpresa"];
			$output["IdPerfil"] = $row["IdPerfil"];
		}
		echo json_encode($output);
	}
?>