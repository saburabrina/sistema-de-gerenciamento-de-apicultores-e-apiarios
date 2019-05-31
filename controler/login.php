<?php

	require_once('../model/Usuario.php');

	session_start();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$cpf = $senha = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $cpf = test_input($_POST["cpf"]);
	  $senha = test_input($_POST["senha"]);

	  $usuario = new Usuario(null, $cpf, null, $senha);
	  $usuario = $usuario->efetuarLogin($cpf, $senha);
	  if($usuario != null){
	  	if($usuario->getSenha() != null){
	  		$_SESSION['nome'] = $usuario->getNome();
	  		$_SESSION['cpf'] = $usuario->getCpf();
	  		$_SESSION['email'] = $usuario->getEmail();
	  		$_SESSION['senha'] = $usuario->getSenha();
	  		header('Location: ../views/dashboard.php');
	  	} else {
	  		# mensagem de senha errada
	  	}
	  } else {
	  	#mensagem de usuario não cadastrado
	  }

	}

?>