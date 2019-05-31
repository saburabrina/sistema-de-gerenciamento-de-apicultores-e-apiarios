<?php
	
	require_once('../model/Usuario.php');
	session_start();

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	if (isset($_POST['submit'])) {
		$caixa = (int) $_POST['caixa'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$colmeia = $user->recuperarCaixaPorId($caixa)->getColmeia();

		$data = $_POST['data'];
		$nome_veterinario = test_input($_POST['nome-veterinario']);
		$crmv
		$doenca
		$produto
		$forma_dosagem
		$quantidade_doses
	}

?>