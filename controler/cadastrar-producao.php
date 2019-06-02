<?php
	require_once('../model/Usuario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$tipo = test_input($_POST['tipo']);
		$destino = test_input($_POST['destino']);
		$rotulo = test_input($_POST['rotulo']);
		$material = test_input($_POST['material']);
		$apiario = test_input($_POST['apiario']);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$status = $user->cadastrarProducao($apiario, $rotulo, $destino, $tipo, $material);

		$_SESSION['status'] = $status;

		header('Location: ../views/cadastrar-producao.php');
	}
?>