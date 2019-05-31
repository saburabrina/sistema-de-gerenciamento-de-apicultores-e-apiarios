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
		$ano = $_POST['ano'];
		$apicultor = $_POST['apicultor'];
		$valor_da_producao = $_POST['valor-da-producao'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$status = $user->cadastrarProducaoAnual($ano, $apicultor, $valor_da_producao);

		if ($status) {
			# code...
		} else {
			
		}
	}
?>