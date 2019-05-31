<?php

	require_once('../model/Usuario.php');
	require_once('../model/MedicoesClimaticas.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$data = $temperatura = $umidade = $precipitacao = $propriedade = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$data = test_input($_POST["data"]);
		$temperatura = test_input($_POST["temperatura"]);
		$umidade = test_input($_POST["umidade"]);
		$precipitacao = test_input($_POST["precipitacao"]);
		$propriedade = test_input($_POST["propriedade"]);

	  	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  	$status = $usuario->cadastrarMedicao($data, doubleval($temperatura), doubleval($umidade), doubleval($precipitacao), $propriedade);

	  	$_SESSION['status'] = $status;
	  
	  	header('Location: ../views/buscar-propriedade-para-cadastrar-medicao.php');

	}

?>