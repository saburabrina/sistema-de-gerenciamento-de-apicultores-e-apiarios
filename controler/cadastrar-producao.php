<?php

	require_once('../model/Usuario.php');
	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if (isset($_POST['submit'])) {
		$tipo = $_POST['tipo'];
		$destino = $_POST['destino'];
		$rotulo = $_POST['rotulo'];
		$material = test_input($_POST['material']);
		$apiario = $_POST['apiario']['nome'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$status = $user->cadastrarProducao($apiario, $rotulo, $destino, $tipo, $material);

		if ($status) {
			# code...
		} else {

		}
	}
?>