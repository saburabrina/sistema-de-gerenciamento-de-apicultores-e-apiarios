<?php
	
	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php')
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
		$crmv = test_input($_POST['crmv']);
		$doenca = test_input($_POST['doenca']);
		$produto = test_input($_POST['produto']);
		$forma_dosagem = test_input($_POST['forma-dosagem']);
		$quantidade_doses = test_input($_POST['quantidade-doses']);

		$status = $user->cadastrarTratamento($colmeia, $quantidade_doses, $forma_dosagem, $doenca, $produto, $data, $nome_veterinario, $crmv);

		if ($status) {
			# code...
		} else {
			
		}
	}

?>