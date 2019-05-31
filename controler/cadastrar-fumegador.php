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

	$a = $_SESSION['apicultores'];

	$apicultores = array();
	for($i=0; $i<count($a); $i++){
		$apicultor = unserialize($a[$i]);
		array_push($apicultores, $apicultor);
	}

	$produto = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $produto = test_input($_POST["produto"]);
	  $apicultor = test_input($_POST['apicultor']);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->cadastrarFumegador($apicultores[$apicultor]->getCpf(), $produto);

	  $_SESSION['status'] = $status;
	  header('Location: ../views/buscar-apicultor-para-cadastrar-fumegador.php');

	}

?>