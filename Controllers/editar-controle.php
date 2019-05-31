<?php

	session_start();

	require_once('../model/Usuario.php');
	require_once('../model/ControleVeterinario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$apiario = $data_exame = $cond_vet_geral = $nome_vet = $crmv_vet = $tipo_abelha = $material_biologico = $mel;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $id = test_input($_POST["id"]);
	  $cond_vet_geral = test_input($_POST["cond_vet_geral"]);
	  $nome_vet = test_input($_POST["nome_vet"]);
	  $crmv_vet = test_input($_POST["crmv_vet"]);
	  $tipo_abelha = test_input($_POST["tipo_abelha"]);
	  $material_biologico = test_input($_POST["material_biologico"]);
	  $mel = test_input($_POST["mel"]);

	  $usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
	}

?>
