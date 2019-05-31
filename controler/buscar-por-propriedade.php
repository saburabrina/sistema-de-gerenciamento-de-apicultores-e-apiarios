<?php

	require_once('../model/Usuario.php');
	require_once('../model/Endereco.php');
	require_once('../model/Propriedade.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$areaDestinada = $logradouro = $numero = $complemento = $bairro = $comunidade = $cidade = $estado = $cep = "";

	$checkAreaDestinada = $checkEndereco = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  $areaDestinada = test_input($_POST["area-destinada"]);
	  $logradouro = test_input($_POST["logradouro"]);
	  $numero = test_input($_POST["numero"]);
	  $complemento = test_input($_POST["complemento"]);
	  $bairro = test_input($_POST["bairro"]);
	  $comunidade = test_input($_POST["comunidade"]);
	  $cidade = test_input($_POST["cidade"]);
	  $estado = test_input($_POST["estado"]);
	  $cep = test_input($_POST["cep"]);

	  if(isset($_POST["check-area-destinada"])){
	  	$checkAreaDestinada = test_input($_POST["check-area-destinada"]);
	  }
	  if(isset($_POST["check-endereco"])){
	  	$checkEndereco = test_input($_POST["check-endereco"]);
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $contador = 0;

	  if($checkAreaDestinada == "on"){
	  	$contador += 1;
	  }

	  if($checkEndereco == "on"){
	  	$contador += 1;
	  }

	  if($contador == 0 || $contador == 2){
	  	$propriedades = $usuario->recuperarPropriedades();
	  } else {
	  	if($contador == 1 && $checkEndereco == "on") {
	  		$propriedades = $usuario->recuperarPropriedadesPorEndereco(new Endereco($logradouro, intval($numero), $complemento, $bairro, $comunidade, $cidade, $estado, $cep));
	  	} else {
	  		$propriedades = $usuario->recuperarPropriedadesPorAreaDestinada(doubleval($areaDestinada));
	  	}
	  }

	  /*$filtros = array("nome" => $nome, "dono" => $dono, "inscricao_estadual" => $inscricaoEstadual, "data_fundacao" => $dataFundacao, "latitude" => $latitude, "longitude" => $longitude, "tipo_instalacao" => $tipoInstalacao, "logradouro" => $logradouro, "numero" => $numero, "complemento" => $complemento, "bairro" => $bairro, "comunidade" => $comunidade, "cidade" => $cidade, "estado" => $estado, "cep" => $cep);*/
	
	  $p = array();
	  for($i=0; $i<count($propriedades); $i++){
	  	$propriedade = serialize($propriedades[$i]);
	  	array_push($p, $propriedade);
	  }

	  $_SESSION['propriedades'] = $p;
	  header('Location: ../views/busca-por-propriedade.php');
	}

?>