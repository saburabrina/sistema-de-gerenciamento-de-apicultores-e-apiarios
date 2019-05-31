<?php

	require_once('../model/Usuario.php');
	require_once('../model/Producao.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$checkApiario = $checkRotulo = $checkTipo = $checkDestino = $checkMaterial = "";
	$apiario = $rotulo = $tipo = $destino = $material = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $apiario = test_input($_POST["apiario"]);
	  $rotulo = test_input($_POST["rotulo"]);
	  $tipo = test_input($_POST["tipo"]);
	  $destino = test_input($_POST["destino"]);
	  $material = test_input($_POST["material"]);

	  if(isset($_POST["check-apiario"])){
	  	$checkApiario = test_input($_POST["check-apiario"]);
	  }
	  if(isset($_POST["check-rotulo"])){
	  	$checkRotulo = test_input($_POST["check-rotulo"]);
	  }
	  if(isset($_POST["check-tipo"])){
	  	$checkTipo = test_input($_POST["check-tipo"]);
	  }
	  if(isset($_POST["check-destino"])){
	  	$checkDestino = test_input($_POST["check-destino"]);
	  }
	  if(isset($_POST["check-material"])){
	  	$checkMaterial = test_input($_POST["check-material"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkApiario == "on"){
	  	$contador += 1;
	  }

	  if($checkRotulo == "on"){
	  	$contador += 1;
	  }

	  if($checkTipo == "on"){
	  	$contador += 1;
	  }

	  if($checkDestino == "on"){
	  	$contador += 1;
	  }

	  if($checkMaterial == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 5){
	  	$producoes = $usuario->recuperarProducoes(array());
	  } else {
	  	$filtros = array("apiario" => $apiario, "rotulo" => $rotulo, "tipo" => $tipo, "destino" => $destino, "material" => $material);
	  	$producoes = $usuario->recuperarProducoes($filtros);
	  }

	  $p = array();
	  for($i=0; $i<count($producoes); $i++){
	  	$producao = serialize($producoes[$i]);
	  	array_push($p, $producao);
	  }

	  $_SESSION['producoes'] = $p;
	  header('Location: ../views/busca-por-producao.php');

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