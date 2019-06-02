<?php

	require_once('../model/Usuario.php');
	require_once('../model/Endereco.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$nome = $cpf = $telefone = $email = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = $perfil = $certificacao = $vinculo = $logradouroPropriedade = $numeroPropriedade = $complementoPropriedade = $bairroPropriedade = $comunidadePropriedade = $cidadePropriedade = $estadoPropriedade = $cepPropriedade = $checkNome = $checkCpf = $checkTelefone = $checkEmail = $checkEnderecoResidencial = $checkPerfil = $checkCertificacao = $checkVinculo = $checkEnderecoPropriedade = $vinculo = $checkVinculo = "";

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
	  $vinculo = test_input($_POST["vinculo"]);
	  $logradouroPropriedade = test_input($_POST["logradouroPropriedade"]);
	  $numeroPropriedade = test_input($_POST["numeroPropriedade"]);
	  $complementoPropriedade = test_input($_POST["complementoPropriedade"]);
	  $bairroPropriedade = test_input($_POST["bairroPropriedade"]);
	  $comunidadePropriedade = test_input($_POST["comunidadePropriedade"]);
	  $cidadePropriedade = test_input($_POST["cidadePropriedade"]);
	  $estadoPropriedade = test_input($_POST["estadoPropriedade"]);

	  if(isset($_POST["check-nome"])){
	  	$checkNome = test_input($_POST["check-nome"]);
	  }
	  if(isset($_POST["check-cpf"])){
	  	$checkCpf = test_input($_POST["check-cpf"]);
	  }	  
	  if(isset($_POST["check-telefone"])){
	  	$checkTelefone = test_input($_POST["check-telefone"]);
	  }
	  if(isset($_POST["check-email"])){
	  	$checkEmail = test_input($_POST["check-email"]);
	  }
	  if(isset($_POST["check-endereco-residencial"])){
	  	$checkEnderecoResidencial = test_input($_POST["check-endereco-residencial"]);
	  }
	  if(isset($_POST["check-perfil"])){
	  	$checkPerfil = test_input($_POST["check-perfil"]);
	  }
	  if(isset($_POST["check-certificacao"])){
	  	$checkCertificacao = test_input($_POST["check-certificacao"]);
	  }
	  if(isset($_POST["check-vinculo"])){
	  	$checkVinculo = test_input($_POST["check-vinculo"]);
	  }
	  if(isset($_POST["check-endereco-propriedade"])){
	  	$checkEnderecoPropriedade = test_input($_POST["check-endereco-propriedade"]);
	  }
	  if(isset($_POST["check-vinculo"])){
	  	$checkVinculo = test_input($_POST["check-vinculo"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkNome == "on"){
	  	$contador += 1;
	  }

	  if($checkCpf == "on"){
	  	$contador += 1;
	  }

	  if($checkTelefone == "on"){
	  	$contador += 1;
	  }

	  if($checkEmail == "on"){
	  	$contador += 1;
	  }

	  if($checkEnderecoResidencial == "on"){
	  	$contador += 1;
	  }

	  if($checkPerfil == "on"){
	  	$contador += 1;
	  }

	  if($checkCertificacao == "on"){
	  	$contador += 1;
	  }

	  if($checkVinculo == "on"){
	  	$contador += 1;
	  }

	  if($checkEnderecoPropriedade == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 9){
	  	$apicultores = $usuario->recuperarApicultores(array());
	  } else {
	  	$filtros = array("nome" => $nome, "cpf" => $cpf, "telefone" => $telefone, "email" => $email, "logradouro" => $logradouro, "numero" => $numero, "complemento" => $complemento, "bairro" => $bairro, "comunidade" => $comunidade, "cidade" => $cidade, "estado" => $estado, "cep" => $cep, "perfil" => $perfil, "certificacao" => $certificacao, "vinculo" => $vinculo);
	  	$apicultores = $usuario->recuperarApicultores($filtros);
	  }

	  $a = array();
	  for($i=0; $i<count($apicultores); $i++){
	  	$apicultor = serialize($apicultores[$i]);
	  	array_push($a, $apicultor);
	  }

	  $_SESSION['apicultores'] = $a;
	  header('Location: ../views/buscar-apicultor-para-cadastrar-fumegador.php');

	  /*$filtros = array("nome" => $nome, "dono" => $dono, "inscricao_estadual" => $inscricaoEstadual, "data_fundacao" => $dataFundacao, "latitude" => $latitude, "longitude" => $longitude, "tipo_instalacao" => $tipoInstalacao, "logradouro" => $logradouro, "numero" => $numero, "complemento" => $complemento, "bairro" => $bairro, "comunidade" => $comunidade, "cidade" => $cidade, "estado" => $estado, "cep" => $cep);
	
	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $apiarios = $usuario->recuperarApiarios($filtros);

	  $a = array();
	  for($i=0; $i<count($apiarios); $i++){
	  	$apiario = serialize($apiarios[$i]);
	  	array_push($a, $apiario);
	  }

	  $_SESSION['apiarios'] = $a;
	  header('Location: ../views/busca-por-apiario.php');*/
	}

?>