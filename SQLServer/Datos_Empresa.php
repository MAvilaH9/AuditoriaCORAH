<?php
    // session_start();
	require_once "Conexion_Auditoria.php";

	if(isset($_POST["IdEmpresa"]))
	{
		$id=$_POST['IdEmpresa'];
		$output = array();
		$sql=$pdo->prepare(
			"SELECT * FROM Empresa 
			WHERE IdEmpresa = '$id'"
		);
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{

			$output["NombreEmpresa"] = $row["NombreEmpresa"];
			$output["NombreBD"] = $row["NombreBaseDatos"];

		}
		echo json_encode($output);
	}
?>