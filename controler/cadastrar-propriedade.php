<?php
	require_once('../model/Usuario.php');
	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if (isset($_POST['submit'])) {
		// propriedade
		$area_destinada = test_input($_POST['area']);

		// endereco
		$logradouro = test_input($_POST['logradouro']);
		$numero = (int) test_input($_POST['numero']);
		$complemento = test_input($_POST['complemento']);
		$bairro = test_input($_POST['bairro']);
		$comunidade = test_input($_POST['comunidade']);
		$cidade = test_input($_POST['cidade']);
		$estado = test_input($_POST['estado']);
		$cep = test_input($_POST['cep']);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$user->cadastrarEndereco($logradouro, $numero, $complemento, $bairro, $comunidade, $cidade, $estado, $cep);
		$endereco = $user->recuperarIdEndereco($logradouro, $numero, $complemento, $bairro, $comunidade, $cidade, $estado, $cep);
		$user->cadastrarPropriedade($endereco, $area_destinada);

	}
?>