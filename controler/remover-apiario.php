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

	$c = $_SESSION['apiarios'];
	$apiarios = array();
	for($i=0; $i<count($c); $i++){
		$apiario = unserialize($c[$i]);
		array_push($apiarios, $apiario);
	}    

	$apiario = test_input($_GET['apiario']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerApiario($apicultores[$apicultor]);

	if($status){
		echo 'Apiario removido com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover a caixa';
	}
	
	header('Location: ../views/busca-por-apiario.php');
?>