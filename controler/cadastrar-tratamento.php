<?php
	
	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php');

	session_start();

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$caixa = test_input($_POST['caixa']);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$colmeia = $user->recuperarCaixaPorId($caixa)->getColmeia();
		$data = test_input($_POST['data']);
		$nome_veterinario = test_input($_POST['nome-veterinario']);
		$crmv = test_input($_POST['crmv']);
		$doenca = test_input($_POST['doenca']);
		$produto = test_input($_POST['produto']);
		$forma_dosagem = test_input($_POST['forma-dosagem']);
		$quantidade_doses = test_input($_POST['quantidade-doses']);
		$status = $user->cadastrarTratamento($colmeia, $quantidade_doses, $forma_dosagem, $doenca, $produto, $data, $nome_veterinario, $crmv);
		
		$_SESSION['status'] = $status;

		header('Location: ../views/cadastrar-tratamento.php');
	}
?>