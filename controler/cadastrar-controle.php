<?php
	require_once("../model/Usuario.php");

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if (isset($_POST['submit'])) {
		
		// controle-veterinario
		$data = $_POST['date'];
		$nome = test_input($_POST['nome-veterinario']);
		$crmv = test_input($_POST['crmv']);
		$condicao = test_input($_POST['condicao-veterinaria']);

		// amostras
		$tipo_abelha = test_input($_POST['tipo-abelha']);
		$mel = test_input($_POST['mel']);
		$material_biologico = test_input($_POST['material-biologico']);
		$apiario = $_POST['apiario']['nome'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$user->cadastrarControleVeterinario($apiario, $data, $condicao, $nome, $crmv);

		$controle = $user->recuperarIdControleVeterinario($apiario, $data, $condicao, $nome, $crmv);
		$user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);

		$numero_amostras = (int) $_POST['numero-amostras'];

		for ($i=2; $i <= $numero_amostras; $i++) { 
			$tipo_abelha = test_input($_POST['tipo-abelha-' . $i]);
			$mel = test_input($_POST['mel-' . $i]);
			$material_biologico = test_input($_POST['material-biologico-' . $i]);

			$user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);
		}
	}
	
?>