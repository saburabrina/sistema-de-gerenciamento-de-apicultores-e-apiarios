<?php
	require_once('../model/Usuario.php');
	require_once('../model/MedicoesClimaticas.php');
	
	session_start();

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	if (isset($_POST['submit'])) {
		$propriedade = $_POST['propriedade'];
		$data = $_POST['data'];
		$temperatura = $_POST['temperatura'];
		$umidade  = $_POST['umidade'];
		$indice_pluviometrico = $_POST['indice-pluviometrico'];

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$medicao_climatica = new MedicoesClimaticas($propriedade, $data, $temperatura, $umidade, $indice_pluviometrico);
		$status = $user->editarMedicaoClimatica($medicao_climatica);

		if ($status) {
			# code...
		} else {
			
		}
	}
?>