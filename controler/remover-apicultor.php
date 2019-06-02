<?php
	require_once('../model/Usuario.php');
	require_once('../model/Apicultor.php');
	session_start();
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$c = $_SESSION['apicultores'];
	$apicultores = array();
	for($i=0; $i<count($c); $i++){
		$apicultor = unserialize($c[$i]);
		array_push($apicultores, $apicultor);
	}    
	$apicultor = test_input($_GET['apicultor']);
	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerApicultor($apicultores[$apicultor]);
	if($status){
		echo 'Apicultor removido com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover a caixa';
	}
	header('Location: ../views/busca-por-apicultor.php');
?>