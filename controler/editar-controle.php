<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/ControleVeterinario.php');
	require_once('../model/Amostra.php');


	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$id = $data = $nomeVeterinario = $crmvVeterinario = $condicao = $apiario = $numeroAmostras = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $data = test_input($_POST["data"]);
	  $nomeVeterinario = test_input($_POST["nome-veterinario"]);
	  $crmvVeterinario = test_input($_POST["crmv"]);
	  $condicao = test_input($_POST["condicao-veterinaria"]);
	  $data = test_input($_POST["data"]);
	  $numeroAmostras = intval(test_input($_POST['numeroAmostras']));
	  $id = intval(test_input($_POST['controle']));

	  $amostras = array();
	  for($i=0; $i<$numeroAmostras; $i++){
	  	array_push($amostras, new Amostra(0, test_input($_POST["tipo-abelha-" . $i]), test_input($_POST["material-biologico-" . $i]), test_input($_POST["mel-" . $i])));
	  }

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	  $status = $usuario->editarControleVeterinario(new ControleVeterinario($id, $apiario, $data, $condicao, $nomeVeterinario, $crmvVeterinario, $amostras));

	  if($status < count($amostras) + 1){
	  	$_SESSION['status'] = false;
	  } else {
	  	$_SESSION['status'] = true;
	  }
	}

?>
