<?php

	require_once('../model/Usuario.php');
	require_once('../model/Tratamento.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$t = $_SESSION['tratamentos'];

	$tratamentos = array();
	for($i=0; $i<count($t); $i++){
		$tratamento = unserialize($t[$i]);
		array_push($tratamentos, $tratamento);
	}    

	$tratamento = test_input($_GET['tratamento']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerTratamento($tratamentos[$tratamento]);

	if($status){
		echo 'Tratamento removido com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover o tratamento';
	}

	header('Location: ../views/busca-por-tratamento.php');

?>