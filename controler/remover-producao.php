<?php

	require_once('../model/Producao.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$p = $_SESSION['producoes'];

	$producoes = array();
	for($i=0; $i<count($p); $i++){
		$producao = unserialize($p[$i]);
		array_push($producoes, $producao);
	}    

	$producao = test_input($_GET['producao']);

	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	$status = $usuario->removerProducao($producoes[$producao]);

	if($status){
		echo 'Produção removida com sucesso';
		$_SESSION['erro'] = true;
	} else {
		$_SESSION['erro'] = false;
		echo 'Houve um erro ao tentar remover a produção';
	}

	header('Location: ../views/busca-por-producao.php');

?>