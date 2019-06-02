<?php

	require_once('../model/Usuario.php');
	require_once('../model/Endereco.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$apiario = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $apiario = test_input($_POST["apiario"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $caixas = $usuario->recuperarCaixasPorApiario(new Apiario($apiario, null, null, null, null, null, null, null, null, null, null, null, null));

	  $c = array();
	  for($i=0; $i<count($caixas); $i++){
	  	$caixa = serialize($caixas[$i]);
	  	array_push($c, $caixa);
	  }

	  var_dump($c);

	  $_SESSION['caixas'] = $c;
	  //header('Location: ../views/buscar-propriedade-para-cadastrar-apiario.php');
	}

?>