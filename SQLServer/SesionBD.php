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
		$_SESSION['BDEmpresa'] = $resultado['NombreBaseDatos'];
		$_SESSION['NombreEmpresa']= $resultado['NombreEmpresa'];
	}
?>