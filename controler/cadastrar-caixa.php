<?php
	require_once('../models/Usuario.php');
	require_once('../models/Caixa.php');
	require_once('../models/Colmeia.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if (isset($_POST['submit'])) {
		// caixa
		$melgueira = $_POST['melgueiras'];
		$material = test_input($_POST['material']);
		$local_extracao = test_input($_POST['local-extracao']);

		// colmeia
		$origem = $_POST['origem'];
		$especie = $_POST['especie'];
		$data_troca = $_POST['data-troca'];
		$apiario = $_POST['apiario']['nome'];


	  	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  	$status = $usuario->cadastrarColmeia($especie, $origem, $data_troca);

	  	if ($status) {
			# code...
		} else {

		}

	  	$colmeia = $usuario->recuperarIdColmeia($especie, $origem, $data_troca);
	  	$status_caixa = $usuario->cadastrarCaixa($apiario, $colmeia, $material, $melgueira, $local_extracao);

	  	if ($status_caixa) {
			# code...
		} else {

		}
	}
?>