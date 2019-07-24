<?php
	session_start();

	if (!empty($_POST['Empresa'])) {
		$_SESSION['Empresa'] = $_POST['Empresa'];
	}
?>