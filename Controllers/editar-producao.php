<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Producao.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$apiario = $rotulo = $destino = $tipo = $material;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $apiario = test_input($_POST["apiario"]);
	  $rotulo = test_input($_POST["rotulo"]);
	  $destino = test_input($_POST["destino"]);
	  $material = test_input($_POST["material"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	}

?>
