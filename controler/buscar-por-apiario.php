<?php

	require_once('../model/Usuario.php');
	require_once('../model/Apiario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$nome = $dono = $inscricaoEstadual = $dataFundacao = $latitude = $longitude = $tipoInstalacao = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = "";

	$checkNome = $checkDono = $checkInscricao = $checkData = $checkLatitude = $checkLongitude = $checkInstalacao = $checkEndereco = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $nome = test_input($_POST["nome"]);
	  $dono = test_input($_POST["dono"]);
	  $inscricaoEstadual = test_input($_POST["inscricao"]);
	  $dataFundacao = test_input($_POST["data-fundacao"]);
	  $latitude = test_input($_POST["latitude"]);
	  $longitude = test_input($_POST["longitude"]);
	  $tipoInstalacao = test_input($_POST["instalacao"]);
	  $logradouro = test_input($_POST["logradouro"]);
	  $numero = test_input($_POST["numero"]);
	  $complemento = test_input($_POST["complemento"]);
	  $bairro = test_input($_POST["bairro"]);
	  $comunidade = test_input($_POST["comunidade"]);
	  $cidade = test_input($_POST["cidade"]);
	  $estado = test_input($_POST["estado"]);
	  $cep = test_input($_POST["cep"]);

	  if(isset($_POST["check-nome"])){
	  	$checkNome = test_input($_POST["check-nome"]);
	  }

	  if(isset($_POST["check-dono"])){
	  	$checkDono = test_input($_POST["check-dono"]);
	  }

	  if(isset($_POST["check-inscricao"])){
	  	$checkInscricao = test_input($_POST["check-inscricao"]);
	  }

	  if(isset($_POST["check-data-fundacao"])){
	  	$checkData = test_input($_POST["check-data-fundacao"]);
	  }

	  if(isset($_POST["check-latitude"])){
	  	$checkLatitude = test_input($_POST["check-latitude"]);
	  }

	  if(isset($_POST["check-longitude"])){
	  	$checkLongitude = test_input($_POST["check-longitude"]);
	  }

	  if(isset($_POST["check-endereco"])){
	  	$checkEndereco = test_input($_POST["check-endereco"]);
	  }

	  if(isset($_POST["check-instalacao"])){
	  	$checkInstalacao = test_input($_POST["check-instalacao"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkInstalacao == "on"){
	  	$contador += 1;
	  }

	  if($checkEndereco == "on"){
	  	$contador += 1;
	  }

	  if($checkLongitude == "on"){
	  	$contador += 1;
	  }

	  if($checkLatitude == "on"){
	  	$contador += 1;
	  }

	  if($checkNome == "on"){
	  	$contador += 1;
	  }

	  if($checkDono == "on"){
	  	$contador += 1;
	  }

	  if($checkInscricao == "on"){
	  	$contador += 1;
	  }

	  if($checkData == "on"){
	  	$contador += 1;
	  }

	  if($contador == 0 || $contador == 8){
	  	$apiarios = $usuario->recuperarApiarios(array());
	  } else {
	  	$filtros = array("nome" => $nome, "dono" => $dono, "inscricao_estadual" => $inscricaoEstadual, "data_fundacao" => $dataFundacao, "latitude" => $latitude, "longitude" => $longitude, "tipo_instalacao" => $tipoInstalacao, "logradouro" => $logradouro, "numero" => $numero, "complemento" => $complemento, "bairro" => $bairro, "comunidade" => $comunidade, "cidade" => $cidade, "estado" => $estado, "cep" => $cep);
	  	$apiarios = $usuario->recuperarApiarios($filtros);
	  }

	  /*$filtros = array("nome" => $nome, "dono" => $dono, "inscricao_estadual" => $inscricaoEstadual, "data_fundacao" => $dataFundacao, "latitude" => $latitude, "longitude" => $longitude, "tipo_instalacao" => $tipoInstalacao, "logradouro" => $logradouro, "numero" => $numero, "complemento" => $complemento, "bairro" => $bairro, "comunidade" => $comunidade, "cidade" => $cidade, "estado" => $estado, "cep" => $cep);*/
	
	  $a = array();
	  for($i=0; $i<count($apiarios); $i++){
	  	$apiario = serialize($apiarios[$i]);
	  	array_push($a, $apiario);
	  }

	  $_SESSION['apiarios'] = $a;
	  header('Location: ../views/busca-por-apiario.php');
	}

?>