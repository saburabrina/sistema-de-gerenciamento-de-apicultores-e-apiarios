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
		$status_controle = $user->cadastrarControleVeterinario($apiario, $data, $condicao, $nome, $crmv);

		if ($status_controle) {
			# code...
		} else {

		}

		$controle = $user->recuperarIdControleVeterinario($apiario, $data, $condicao, $nome, $crmv);
		$status_amostra = $user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);

		if ($status_amostra) {
			# code...
		} else {

		}

		$numero_amostras = (int) $_POST['numero-amostras'];

		for ($i=2; $i <= $numero_amostras; $i++) { 
			$tipo_abelha = test_input($_POST['tipo-abelha-' . $i]);
			$mel = test_input($_POST['mel-' . $i]);
			$material_biologico = test_input($_POST['material-biologico-' . $i]);

			$status_amostra = $user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);

			if ($status_amostra) {
				# code...
			} else {

			}
		}
	}
	
?>