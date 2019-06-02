<?php

	require_once('../model/Usuario.php');
	require_once('../model/ProducaoAnual.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$p = $_SESSION['producoes_anuais'];

	$producoes = array();
	for($i=0; $i<count($p); $i++){
		$producao = unserialize($p[$i]);
		array_push($producoes, $producao);
	}    

	$producao = test_input($_GET['producao']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerProducaoAnual($producoes[$producao]);

	$_SESSION['erro'] = $status;

	header('Location: ../views/busca-por-producao-anual.php');

?>