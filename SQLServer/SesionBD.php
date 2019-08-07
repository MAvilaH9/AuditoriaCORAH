<?php

	require_once "Conexion_Auditoria.php";

	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 


	if (!empty($_POST['Empresa'])) {
		
		$Empresa=$_POST['Empresa'];
		$sql= $pdo->prepare("SELECT * FROM Empresa WHERE NombreEmpresa='$Empresa'");
		$sql->execute(array($Empresa));
		$resultado=$sql->fetch();
		$_SESSION['Empresa'] = $resultado['NombreBaseDatos'];
		$_SESSION['NomEmpresa']= $resultado['NombreEmpresa'];
	}
?>