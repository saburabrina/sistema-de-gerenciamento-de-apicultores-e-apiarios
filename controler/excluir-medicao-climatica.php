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
		$propriedade = $_POST['propriedade'];
		$data = $_POST['data'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$status = $user->excluirMedicaoClimatica($propriedade, $data);

		if ($status) {
			# code...
		} else {
			
		}
	}
?>