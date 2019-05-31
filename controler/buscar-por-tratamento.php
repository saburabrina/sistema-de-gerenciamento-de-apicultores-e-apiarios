<?php

	require_once('../model/Usuario.php');
	require_once('../model/Tratamento.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$checkData = $checkNomeVeterinario = $checkCrmvVeterinario = $checkDoenca = $checkProduto = "";
	$dataTratamento = $nomeVeterinario = $crmvVeterinario = $doenca = $produto = ""; 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $dataTratamento = test_input($_POST["data"]);
	  $nomeVeterinario = test_input($_POST["nome-veterinario"]);
	  $crmvVeterinario = test_input($_POST["crmv-veterinario"]);
	  $doenca = test_input($_POST["doenca"]);
	  $produto = test_input($_POST["produto"]);

	  if(isset($_POST["check-data"])){
	  	$checkData = test_input($_POST["check-data"]);
	  }
	  if(isset($_POST["check-nome-veterinario"])){
	  	$checkNomeVeterinario = test_input($_POST["check-nome-veterinario"]);
	  }
	  if(isset($_POST["check-crmv-veterinario"])){
	  	$checkCrmvVeterinario = test_input($_POST["check-crmv-veterinario"]);
	  }
	  if(isset($_POST["check-doenca"])){
	  	$checkDoenca = test_input($_POST["check-doenca"]);
	  }
	  if(isset($_POST["check-produto"])){
	  	$checkProduto = test_input($_POST["check-produto"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkData == "on"){
	  	$contador += 1;
	  }

	  if($checkNomeVeterinario == "on"){
	  	$contador += 1;
	  }

	  if($checkCrmvVeterinario == "on"){
	  	$contador += 1;
	  }

	  if($checkDoenca == "on"){
	  	$contador += 1;
	  }

	  if($checkProduto == "on"){
	  	$contador += 1;
	  }


	  if($contador == 0 || $contador == 5){
	  	$tratamentos = $usuario->recuperarTratamentos(array());
	  } else {
	  	$filtros = array("data_tratamento" => $dataTratamento, "nome_veterinario" => $nomeVeterinario, "crmv_veterinario" => $crmvVeterinario, "doenca" => $doenca, "produto" => $produto);
	  	$tratamentos = $usuario->recuperarTratamentos($filtros);
	  }

	  $t = array();
	  for($i=0; $i<count($tratamentos); $i++){
	  	$tratamento = serialize($tratamentos[$i]);
	  	array_push($t, $tratamento);
	  }

	  $_SESSION['tratamentos'] = $t;
	  header('Location: ../views/busca-por-tratamento.php');

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