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

	if (isset($_POST['submit'])) {
		$nome = test_input($_POST['nome']);
		$dono = test_input($_POST['dono']);
		$propriedade = (int) test_input($_POST['propriedade']);
		$inscricao = test_input($_POST['inscricao']);
		$data_fundacao = $_POST['data-fundacao'];
		if($_POST['florada'] == 'outro'){
			$tipo_florada = $_POST['outra-florada'];
		}
		else {
			$tipo_florada = $_POST['florada'];
		}	
		$latitude = (float) test_input($_POST['latitude']);
		$longitude = (float) test_input($_POST['longitude']);
		$expandida = $_POST['expandido'];
		$problema_sanitario = $_POST['sanitario'];
		$num_caixas_povoadas = $_POST['caixas-povoadas'];
		$num_caixas_vazias = $_POST['caixas-vazias'];
		$tipo_instalacao = $_POST['instalacao'];

		$apiario = new Apiario($nome, $dono, $propriedade, $inscricao, $data_fundacao, $tipo_florada, $latitude, $longitude, $expandida, $problema_sanitario, $num_caixas_povoadas, $num_caixas_vazias, $tipo_instalacao);

		$user = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);
		$status = $user->editarApiario($apiario);

		if ($status) {
			# code...
		} else {
			
		}
	}

?>