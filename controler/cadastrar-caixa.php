<?php
	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php');
	require_once('../model/Colmeia.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// caixa
		$melgueira = $_POST['melgueiras'];
		$material = test_input($_POST['material']);
		$local_extracao = test_input($_POST['local-extracao']);

		// colmeia
		$origem = $_POST['origem'];
		$especie = $_POST['especie'];
		$data_troca = $_POST['data-troca'];
		$apiario = $_POST['apiario'];

	  	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  	$status = $usuario->cadastrarColmeia($especie, $origem, $data_troca);

	  	if ($status) {
			$colmeia = $usuario->recuperarIdColmeia($especie, $origem, $data_troca);

		  	$status_caixa = $usuario->cadastrarCaixa($apiario, $colmeia, $material, $melgueira, $local_extracao);
		  	
		  	$_SESSION['status'] = $status_caixa;

		} else {
			$_SESSION['status'] = false;
		}

		header('Location: ../views/cadastrar-caixa.php');
	}
?>