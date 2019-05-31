<?php

	require_once('../model/Usuario.php');
	require_once('../model/Propriedade.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$p = $_SESSION['propriedades'];

	$propriedades = array();
	for($i=0; $i<count($p); $i++){
		$propriedade = unserialize($p[$i]);
		array_push($propriedades, $propriedade);
	}    

	$propriedade = test_input($_GET['propriedade']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerPropriedade($propriedades[$propriedade]);

	if($status){
		echo 'Propriedade removida com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover a propriedade';
	}

	header('Location: ../views/busca-por-propriedade.php');

?>