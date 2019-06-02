<?php
	require_once('../model/Usuario.php');
	require_once('../model/ProducaoAnual.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$checkAno = $checkApicultor = $checkValor = "";		
	  
		$ano = test_input($_POST["ano"]);
		$valor = test_input($_POST["valor"]);
		$apicultor = test_input($_POST['apicultor']);

		if(isset($_POST["check-ano"])){
			$checkAno = test_input($_POST["check-ano"]);
		}

		if(isset($_POST["check-apicultor"])){
			$checkApicultor = test_input($_POST["check-apicultor"]);
		}

		if(isset($_POST["check-valor"])){
			$checkValor = test_input($_POST["check-valor"]);
		}

		$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);

		$contador = 0;

		if($checkApicultor == "on"){
			$contador += 1;
		}

		if($checkAno == "on"){
			$contador += 1;
		}

		if($checkValor == "on"){
			$contador += 1;
		}

		if($contador == 0 || $contador == 3){
			$producoes = $usuario->recuperarProducaoAnual(array());
		} else {
			$filtros = array("apicultor" => $apicultor, "ano" => $ano, "valor" => $valor);
			$producoes = $usuario->recuperarProducaoAnual($filtros);
		}

		$p = array();
		for($i=0; $i<count($producoes); $i++){
			$producao = serialize($producoes[$i]);
			array_push($p, $producao);
		}

		$_SESSION['producoes_anuais'] = $p;
		header('Location: ../views/busca-por-producao-anual.php');
	}
?>