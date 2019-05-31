<?php

	require_once('../model/Usuario.php');
	require_once('../model/Apicultor.php');
	require_once('../model/Propriedade.php');
	require_once('../model/Endereco.php');


	session_start();

	function test_input($data) {
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

	$nome = $cpf = $telefone = $email = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = $perfil = $certificacao = $outraCertificacao = $vinculo = $logradouroPropriedade = $numeroPropriedade = $complementoPropriedade = $bairroPropriedade = $comunidadePropriedade = $cidadePropriedade = $estadoPropriedade = $cepPropriedade = $apicultor = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nome = test_input($_POST["nome"]);
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

	  $apicultor = intval(test_input($_POST["apicultor"]));

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);

	  $enderecoApicultor = new Endereco($apicultores[$apicultor]->getEndereco()->getId(), $logradouro, intval($numero), $complemento, $bairro, $comunidade, $cidade, $estado, $cep);
	  $propriedade = new Propriedade(1, new Endereco(null/*$apicultores[$apicultor]->getTrabalhaEm()->getEndereco()->getId()*/, $logradouroPropriedade, intval($numeroPropriedade), $complementoPropriedade, $bairroPropriedade, $comunidadePropriedade, $cidadePropriedade, $estadoPropriedade, $cepPropriedade), 0);
	  
	  $status = $usuario->editarApicultor(new Apicultor($cpf, $nome, $certificacao, $email, $telefone, $perfil, $vinculo, $enderecoApicultor, $propriedade));

	  $_SESSION['status'] = $status;

	  header('Location: ../views/buscar-por-apicultor.php');
	}

?>