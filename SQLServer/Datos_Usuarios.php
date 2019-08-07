<?php
    // session_start();
	require_once "Conexion_Auditoria.php";

	if(isset($_POST["IdUsuario"]))
	{
		$id=$_POST['IdUsuario'];
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
			$output["Nombre"] = $row["Nombre"];
			$output["Usuario"] = $row["Usuario"];
			$output["Contrasena"] = $row["Contrasena"];
		}
		echo json_encode($output);
	}
?>