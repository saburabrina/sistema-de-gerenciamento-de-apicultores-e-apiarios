<?php

	require_once('../model/Usuario.php');
	require_once('../model/ControleVeterinario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$c = $_SESSION['controles'];

	$controles = array();
	for($i=0; $i<count($c); $i++){
		$controle = unserialize($c[$i]);
		array_push($controles, $controle);
	}    

	$controle = test_input($_GET['controle']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerControle($controles[$controle]);

	if($status){
		echo 'Controle Veterinário removido com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover o controle veterinário';
	}

	header('Location: ../views/buscar-por-controle.php');

?>