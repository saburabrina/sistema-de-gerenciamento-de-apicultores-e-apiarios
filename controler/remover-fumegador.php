<?php

	require_once('../model/Usuario.php');
	require_once('../model/Fumegador.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$f = $_SESSION['fumegadores'];

	$fumegadores = array();
	for($i=0; $i<count($f); $i++){
		$fumegador = unserialize($f[$i]);
		array_push($fumegadores, $fumegador);
	}    

	$fumegador = test_input($_GET['fumegador']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerFumegador($fumegadores[$fumegador]);

	if($status){
		echo 'Fumegador removido com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover o fumegador';
	}

	header('Location: ../views/busca-por-fumegador.php');

?>