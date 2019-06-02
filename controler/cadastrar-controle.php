<?php

	require_once("../model/Usuario.php");

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// controle-veterinario
		$data = test_input($_POST['data']);
		$nome = test_input($_POST['nome-veterinario']);
		$crmv = test_input($_POST['crmv']);
		$condicao = test_input($_POST['condicao-veterinaria']);

		// amostras
		$tipo_abelha = test_input($_POST['tipo-abelha']);
		$mel = test_input($_POST['mel']);
		$material_biologico = test_input($_POST['material-biologico']);
		$apiario = test_input($_POST['apiario']);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		
		$status_controle = $user->cadastrarControleVeterinario($apiario, $data, $condicao, $nome, $crmv);
		if ($status_controle) {
			$controle = $user->recuperarIdControleVeterinario($apiario, $data, $condicao, $nome, $crmv);
			$status_amostra = $user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);
			if ($status_amostra) {
				$numero_amostras = intval(test_input($_POST['numero-amostras']));
				for ($i=2; $i < $numero_amostras; $i++) { 
					$tipo_abelha = test_input($_POST['tipo-abelha-' . $i]);
					$mel = test_input($_POST['mel-' . $i]);
					$material_biologico = test_input($_POST['material-biologico-' . $i]);
					$status_amostra = $user->cadastrarAmostra($controle, $tipo_abelha, $material_biologico, $mel);
					if ($status_amostra) {
						$_SESSION['status'] = true;
					} else {
						$_SESSION['status'] = false;
					}
				}
			} else {
				$_SESSION['status'] = false;
			}
		} else {
			$_SESSION['status'] = false;
		}

		header('Location: ../views/cadastrar-controle.php');
		
	}
	
?>