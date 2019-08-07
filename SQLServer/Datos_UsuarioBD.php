<?php
    // session_start();
	require_once "Conexion_Auditoria.php";

	if(isset($_POST["IdUsuarioBD"]))
	{
		$id=$_POST['IdUsuarioBD'];
		$output = array();
		$sql=$pdo->prepare(
			"SELECT * FROM UsuarioBD
			WHERE IdUsuarioBD = '$id'"
		);
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{

			$output["Usuario"] = $row["Usuario"];
			$output["Contrasena"] = $row["Contrasena"];

		}
		echo json_encode($output);
	}
?>