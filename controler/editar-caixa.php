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
	  	$colmeiaId = $usuario->recuperarIdColmeia($especie, $origem, $data_troca);
	  	$colmeia = new Colmeia($colmeiaId, $especie, $origem, $data_troca);
	  	$status = $usuario->editarColmeia($colmeia);

	  	if ($status) {
			# code...
		} else {

		}

		$caixaId = $usuario->recuperarIdCaixa($apiario, $colmeia, $material, $melgueira, $local_extracao);
	  	$caixa = new Caixa($caixaId, $apiario, $colmeia, $material, $melgueira, $local_extracao);
	  	$status_caixa = $usuario->editarCaixa($caixa);

	  	if ($status_caixa) {
			# code...
		} else {

		}
	}
?>