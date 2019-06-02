<?php

	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php');


	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$checkApiario = $checkMelgueiras = $checkMaterial = $checkLocalExtracao = "";
	$apiario = $melgueiras = $material = $localExtracao = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $apiario = test_input($_POST["apiario"]);
	  $melgueiras = test_input($_POST["melgueiras"]);
	  $material = test_input($_POST["material"]);
	  $localExtracao = test_input($_POST["local-extracao"]);


	  if(isset($_POST["check-apiario"])){
	  	$checkApiario = test_input($_POST["check-apiario"]);
	  }
	  if(isset($_POST["check-melgueiras"])){
	  	$checkMelgueiras = test_input($_POST["check-melgueiras"]);
	  }
	  if(isset($_POST["check-material"])){
	  	$checkMaterial = test_input($_POST["check-material"]);
	  }
	  if(isset($_POST["check-local-extracao"])){
	  	$checkLocalExtracao = test_input($_POST["check-local-extracao"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkApiario == "on"){
	  	$contador += 1;
	  }

	  if($checkMelgueiras == "on"){
	  	$contador += 1;
	  }

	  if($checkMaterial == "on"){
	  	$contador += 1;
	  }

	  if($checkLocalExtracao == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 4){
	  	$caixas = $usuario->recuperarCaixas(array());
	  } else {
	  	$filtros = array("apiario" => $apiario, "melgueiras" => $melgueiras, "material" => $material, "local_extracao" => $localExtracao);
	  	$caixas = $usuario->recuperarCaixas($filtros);
	  }

	  $c = array();
	  for($i=0; $i<count($caixas); $i++){
	  	$caixa = serialize($caixas[$i]);
	  	array_push($c, $caixa);
	  }

	  $_SESSION['caixas'] = $c;
	  header('Location: ../views/buscar-caixa-para-cadastrar-tratamento.php');

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