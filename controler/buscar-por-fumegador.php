<?php

	require_once('../model/Fumegador.php');
	require_once('../model/Usuario.php');
	require_once('../model/Endereco.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$apicultor = $produto = $checkApicultor = $checkProduto = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $apicultor = test_input($_POST["apicultor"]);
	  $produto = test_input($_POST["produto"]);

	  if(isset($_POST["check-apicultor"])){
	  	$checkApicultor = test_input($_POST["check-apicultor"]);
	  }

	  if(isset($_POST["check-produto"])){
	  	$checkProduto = test_input($_POST["check-produto"]);
	  }  

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkApicultor == "on"){
	  	$contador += 1;
	  }

	  if($checkProduto == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 2){
	  	$fumegadores = $usuario->recuperarFumegadores();
	  } else {
	  	$filtros = array("apicultor" => $apicultor, "produto" => $produto);
	  	$fumegadores = $usuario->recuperarFumegadoresPorAtributos($filtros);
	  }

	  $f = array();
	  for($i=0; $i<count($fumegadores); $i++){
	  	$fumegador = serialize($fumegadores[$i]);
	  	array_push($f, $fumegador);
	  }

	  var_dump($fumegadores);

	  $_SESSION['fumegadores'] = $f;
	  header('Location: ../views/busca-por-fumegador.php');

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