<?php
	require_once('../model/Usuario.php');

	session_start();

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$a = $_SESSION['apicultores'];

	$apicultores = array();
	for($i=0; $i<count($a); $i++){
		$apicultor = unserialize($a[$i]);
		array_push($apicultores, $apicultor);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ano = test_input($_POST['ano']);
		$apicultor = intval(test_input($_POST['apicultor']));
		$valor_da_producao = test_input($_POST['valor']);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);

		$status = $user->cadastrarProducaoAnual($ano, $apicultores[$apicultor]->getCpf(), $valor_da_producao);
		
		$_SESSION['status'] = $status;

		header('Location: ../views/buscar-apicultor-para-cadastrar-producao.php');
	}
?>