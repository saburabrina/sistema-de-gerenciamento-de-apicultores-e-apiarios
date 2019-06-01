<?php

	require_once('../model/Usuario.php');
	require_once('../model/ProducaoAnual.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $ano = test_input($_POST["ano"]);
	  $apicultor = test_input($_POST['apicultor']);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $producao_anual = $usuario->recuperarProducaoAnual($ano, $apicultor);

	  $_SESSION['producao-anual'] = $producao_anual;
	}

?>