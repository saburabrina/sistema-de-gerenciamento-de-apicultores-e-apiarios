<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Propriedade.php');
	require_once('../model/Endereco.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$id = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = $area_destinada = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $logradouro = test_input($_POST["logradouro"]);
	  $id = test_input($_POST['id']);
	  $numero = test_input($_POST["numero"]);
	  $complemento = test_input($_POST["complemento"]);
	  $bairro = test_input($_POST["bairro"]);
	  $comunidade = test_input($_POST["comunidade"]);
	  $cidade = test_input($_POST["cidade"]);
	  $estado = test_input($_POST["estado"]);
	  $cep = test_input($_POST["cep"]);
	  $area_destinada = test_input($_POST["area"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->editarPropriedade(new Propriedade($id, new Endereco($logradouro, intval($numero), $complemento, $bairro, $comunidade, $cidade, $estado, $cep), $area_destinada));

	  if($status < 2){
	  	$_SESSION['status'] = false;
	  } else {
	  	$_SESSION['status'] = true;
	  }

	  header('Location: ../views/buscar-por-proprieade.php');
	}

?>
