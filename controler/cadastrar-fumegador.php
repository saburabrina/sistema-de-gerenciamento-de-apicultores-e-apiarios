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

	$produto = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $produto = test_input($_POST["produto"]);
	  $apicultor = test_input($_SESSION['apicultor']['cpf']);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->cadastrarFumegador($apicultor, $produto);

	  if($status) {
	  	# mensagem de sucesso
	  	header('Location: ../views/buscar-apicultor-para-cadastrar-fumegador.php');
	  } else {
	  	# mensagem de erro
	  }
	}

?>