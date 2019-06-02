<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Fumegador.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$apicultor = $produto_utilizado = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $apicultor = test_input($_POST["apicultor"]);
	  $produto_utilizado = test_input($_POST["produto"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->editarFumegaor(new Fumegador($apicultor, $produto_utilizado));

	  $_SESSION['status'] = $status;

	  header('Location: ../views/busca-por-fumegador.php');
	}

?>
