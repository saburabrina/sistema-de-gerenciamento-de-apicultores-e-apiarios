<?php
	require_once('../model/Usuario.php');
	require_once('../model/Caixa.php');
	require_once('../model/Colmeia.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_SESSION['caixas'])){
	      $c = $_SESSION['caixas'];

	      $caixas = array();
	      for($i=0; $i<count($c); $i++){
	        $caixa = unserialize($c[$i]);
	        array_push($caixas, $caixa);
	      }  
	    }

	    $caixa = test_input($_POST['caixa']);

		// caixa
		$melgueira = test_input($_POST['melgueiras']);
		$material = test_input($_POST['material']);
		$local_extracao = test_input($_POST['local-extracao']);

		// colmeia
		$origem = $_POST['origem'];
		$especie = $_POST['especie'];
		$data_troca = $_POST['data-troca'];
		$apiario = $_POST['apiario'];

	  	$usuario = new Usuario($_SESSION['nome'], $_SESSION['cpf'], $_SESSION['email'], $_SESSION['senha']);

	  	$colmeia = unserialize($caixas[$caixa]->getColmeia());
	  	$colmeia->setOrigem($origem);
	  	$colmeia->setEspecieAbelha($especie);
	  	$colmeia->setDataTrocaRainha($data_troca);

	  	$status = $usuario->editarColmeia($colmeia);

	  	if ($status) {
		  	$caixa = $caixas[$caixa];
		  	$caixa->setMelgueira($melgueira);
		  	$caixa->setMaterial($material);
		  	$caixa->setLocalExtracao($local_extracao);
		  
		  	$status_caixa = $usuario->editarCaixa($caixa);
		  	$_SESSION['status'] = $status_caixa;
		} else {
			$_SESSION['status'] = false;
		}

		header('Location: ../views/busca-por-caixa.php');
	}
?>