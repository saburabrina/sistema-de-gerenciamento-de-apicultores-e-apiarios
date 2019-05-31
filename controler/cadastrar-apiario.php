<?php

	require_once('../model/Usuario.php');
	require_once('../model/Apiario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$nome = $dono = $propriedade = $inscricaoEstadual = $dataFundacao = $tipoFlorada = $latitude = $longitude = $expandida = $problemaSanitario = $numCaixasPovoadas = $numCaixasVazias = $tipoInstalacao = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $nome = test_input($_POST["nome"]);
	  $dono = test_input($_POST["dono"]);
	  $propriedade = test_input($_POST["propriedade"]);
	  $inscricaoEstadual = test_input($_POST["inscricao"]);
	  $dataFundacao = test_input($_POST["data-fundacao"]);
	  $tipoFlorada = test_input($_POST["florada"]);
	  $latitude = test_input($_POST["latitude"]);
	  $longitude = test_input($_POST["longitude"]);
	  $expandida = test_input($_POST["expandido"]);
	  $problemaSanitario = test_input($_POST["sanitario"]);
	  $numCaixasPovoadas = test_input($_POST["caixas-povoadas"]);
	  $numCaixasVazias = test_input($_POST["caixas-vazias"]);
	  $tipoInstalacao = test_input($_POST["instalacao"]);

	  if($tipoFlorada == 'outro'){
	  	$tipoFlorada = test_input($_POST["outra-florada"]);
	  }

	  if($expandida == 'on'){
	  	$expandida = "TRUE";
	  } else {
	  	$expandida = "FALSE";
	  }

	  if($problemaSanitario == 'on'){
	  	$problemaSanitario = "TRUE";
	  } else {
	  	$problemaSanitario = "FALSE";
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->cadastrarApiario($nome, $dono, $propriedade, $inscricaoEstadual, $dataFundacao, $tipoFlorada, $latitude, $longitude, $expandida, $problemaSanitario, $numCaixasPovoadas, $numCaixasVazias, $tipoInstalacao);

	  if($status){
	  	#mensagem de sucesso
	  } else {
	  	#mensagem de erro
	  }
	  
	  header('Location: ../views/buscar-propriedade-para-cadastrar-apiario.php');

	}

?>