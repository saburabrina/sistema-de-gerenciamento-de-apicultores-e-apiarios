<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Tratamento.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$colmeia = $quantidade_doses = $forma_dosagem = $doenca = $produto = $data_tratamento = $nome_veterinario = $crmv_veterinario

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $colmeia = test_input($_POST["colmeia"]);
	  $quantidade_doses = test_input($_POST["quantidade-doses"]);
	  $forma_dosagem = test_input($_POST["forma-dosagem"]);
	  $doenca = test_input($_POST["doenca"]);
	  $produto = test_input($_POST["produto"]);
	  $data_tratamento = test_input($_POST["data"]);
	  $nome_veterinario = test_input($_POST["nome-veterinario"]);
	  $crmv_veterinario = test_input($_POST["crmv"]);


	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->editarTratamento(new Tratamento($colmeia, $quantidade_doses, $forma_dosagem, $doenca, $produto, $data_tratamento, $nome_veterinario, $crmv_veterinario));

	  $_SESSION['status'] = $status;

	  header('Location: ../views/busca-por-tratamento.php');
	}

?>
