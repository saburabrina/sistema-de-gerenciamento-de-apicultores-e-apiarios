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

	$apicultor = $produto_utilizado;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $apicultor = test_input($_POST["apicultor"]);
	  $produto_utilizado = test_input($_POST["produto_utilizado"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	}

?>
