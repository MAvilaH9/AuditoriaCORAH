<?php
include("Conexion.php");

if(isset($_POST["idUsuario"]))
{
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM Usuario 
		WHERE IdUsuario = '".$_POST["idUsuario"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
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