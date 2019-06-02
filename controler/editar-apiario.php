<?php
	require_once('../model/Usuario.php');
	require_once('../model/Apiario.php');

	session_start();

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nome = test_input($_POST['nome']);
		$dono = test_input($_POST['dono']);
		$propriedade = test_input($_POST['propriedade']);
		$inscricao = test_input($_POST['inscricao']);
		$data_fundacao = test_input($_POST['data-fundacao']);

		if($_POST['florada'] == 'outro'){
			$tipo_florada = $_POST['outra-florada'];
		}
		else {
			$tipo_florada = $_POST['florada'];
		}	

		$latitude = test_input($_POST['latitude']);
		$longitude = test_input($_POST['longitude']);
		$expandida = test_input($_POST['expandido']);
		$problema_sanitario = test_input($_POST['sanitario']);
		$num_caixas_povoadas = test_input($_POST['caixas-povoadas']);
		$num_caixas_vazias = test_input($_POST['caixas-vazias']);
		$tipo_instalacao = test_input($_POST['instalacao']);

		if($expandida == "on"){
			$expandida = 'TRUE';
		} else {
			$expandida = 'FALSE';
		}

		if($problema_sanitario == "on"){
			$problema_sanitario = 'TRUE';
		} else {
			$problema_sanitario = 'FALSE';
		}

		$apiario = new Apiario($nome, $dono, $propriedade, $inscricao, $data_fundacao, $tipo_florada, $latitude, $longitude, $expandida, $problema_sanitario, $num_caixas_povoadas, $num_caixas_vazias, $tipo_instalacao);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);

		$status = $user->editarApiario($apiario);
		
		$_SESSION['status'] = $status;
		header('Location: ../views/busca-por-apiario.php');
	}
?>