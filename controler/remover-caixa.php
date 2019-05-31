<?php

	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$c = $_SESSION['caixas'];

	$caixas = array();
	for($i=0; $i<count($c); $i++){
		$caixa = unserialize($c[$i]);
		array_push($caixas, $caixa);
	}    

	$caixa = test_input($_GET['caixa']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerCaixa($caixas[$caixa]);

	if($status){
		echo 'Caixa removida com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover a caixa';
	}

	header('Location: ../views/busca-por-caixa.php');

?>