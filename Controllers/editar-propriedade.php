<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Propriedade.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = $area_destinada;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $logradouro = test_input($_POST["logradouro"]);
	  $numero = test_input($_POST["numero"]);
	  $complemento = test_input($_POST["complemento"]);
	  $bairro = test_input($_POST["bairro"]);
	  $comunidade = test_input($_POST["comunidade"]);
	  $cidade = test_input($_POST["cidade"]);
	  $estado = test_input($_POST["estado"]);
	  $cep = test_input($_POST["cep"]);
	  $area_destinada = test_input($_POST["perfil"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	}

?>
