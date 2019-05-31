<?php

	require_once('../model/Usuario.php');
	require_once('../model/Controle.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$checkData = $checkApiario = $checkCondicaoVeterinaria = $checkNomeVeterinario = $checkCrmvVeterinario = "";
	$data = $apiario = $condicao = $nomeVeterinario = $crmvVeterinario = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $data = test_input($_POST["data"]);
	  $apiario = test_input($_POST["apiario"]);
	  $condicao = test_input($_POST["condicao-veterinaria"]);
	  $nomeVeterinario = test_input($_POST["nome-veterinario"]);
	  $crmvVeterinario = test_input($_POST["crmv-veterinario"]);

	  if(isset($_POST["check-data"])){
	  	$checkData = test_input($_POST["check-data"]);
	  }
	  if(isset($_POST["check-apiario"])){
	  	$checkApiario = test_input($_POST["check-apiario"]);
	  }
	  if(isset($_POST["check-condicao-veterinaria"])){
	  	$checkCondicao = test_input($_POST["check-condicao-veterinaria"]);
	  }
	  if(isset($_POST["check-nome-veterinario"])){
	  	$checkNomeVeterinario = test_input($_POST["check-nome-veterinario"]);
	  }
	  if(isset($_POST["check-crmv-veterinario"])){
	  	$checkCrmvVeterinario = test_input($_POST["check-crmv-veterinario"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkData == "on"){
	  	$contador += 1;
	  }

	  if($checkApiario == "on"){
	  	$contador += 1;
	  }

	  if($checkCondicaoVeterinaria == "on"){
	  	$contador += 1;
	  }

	  if($checkNomeVeterinario == "on"){
	  	$contador += 1;
	  }

	  if($checkCrmvVeterinario == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 5){
	  	$controles = $usuario->recuperarControlesVeterinarios(array());
	  } else {
	  	$filtros = array("data_exame" => $data, "apiario" => $apiario, "condicao_vet_geral" => $condicao, "nome_veterinario" => $nomeVeterinario, "crmv_veterinario" => $crmvVeterinario);
	  	$controles = $usuario->recuperarControlesVeterinarios($filtros);
	  }

	  $c = array();
	  for($i=0; $i<count($controles); $i++){
	  	$controle = serialize($controles[$i]);
	  	array_push($c, $controle);
	  }

	  $_SESSION['controles'] = $c;
	  header('Location: ../views/busca-por-controle.php');

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