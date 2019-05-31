<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/Apicultor.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$nome = $cpf = $telefone = $email = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = $perfil = $certificacao = $outraCertificacao = $vinculo = $logradouroPropriedade = $numeroPropriedade = $complementoPropriedade = $bairroPropriedade = $comunidadePropriedade = $cidadePropriedade = $estadoPropriedade = $cepPropriedade;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $cpf = test_input($_POST["cpf"]);
	  $telefone = test_input($_POST["telefone"]);
	  $email = test_input($_POST["email"]);
	  $logradouro = test_input($_POST["logradouro"]);
	  $numero = test_input($_POST["numero"]);
	  $complemento = test_input($_POST["complemento"]);
	  $bairro = test_input($_POST["bairro"]);
	  $comunidade = test_input($_POST["comunidade"]);
	  $cidade = test_input($_POST["cidade"]);
	  $estado = test_input($_POST["estado"]);
	  $cep = test_input($_POST["cep"]);
	  $perfil = test_input($_POST["perfil"]);
	  $certificacao = test_input($_POST["certificacao"]);

	  if($certificao = 'outra'){
	  	$outraCertificacao = test_input($_POST["outra-certificacao"]);
	  }

	  $vinculo = test_input($_POST["vinculo"]);
	  $logradouroPropriedade = test_input($_POST["logradouroPropriedade"]);
	  $numeroPropriedade = test_input($_POST["numeroPropriedade"]);
	  $complementoPropriedade = test_input($_POST["complementoPropriedade"]);
	  $bairroPropriedade = test_input($_POST["bairroPropriedade"]);
	  $comunidadePropriedade = test_input($_POST["comunidadePropriedade"]);
	  $cidadePropriedade = test_input($_POST["cidadePropriedade"]);
	  $estadoPropriedade = test_input($_POST["estadoPropriedade"]);
	  $cepPropriedade = test_input($_POST["cepPropriedade"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	}

?>