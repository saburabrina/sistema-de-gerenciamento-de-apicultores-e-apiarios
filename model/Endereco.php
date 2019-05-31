<?php

	class Endereco {
		private $id;
		private $logradouro;
		private $numero;
		private $complemento;
		private $bairro;
		private $comunidade;
		private $cidade;
		private $estado;
		private $cep;

		function __construct($id, $logradouro, $numero,$complemento, $bairro, $comunidade, $cidade, $estado, $cep){
			$this->id = $id;
			$this->logradouro = $logradouro;
			$this->numero = $numero;
			$this->complemento = $complemento;
			$this->bairro = $bairro;
			$this->comunidade = $comunidade;
			$this->cidade = $cidade;
			$this->estado = $estado;
			$this->cep = $cep;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getLogradouro(){
			return $this->logradouro;
		}

		public function setLogradouro($logradouro){
			$this->logradouro = $lograduro;
		}

		public function getNumero(){
			return $this->numero;
		}

		public function setNumero($numero){
			$this->numero = $numero;
		}

		public function getComplemento(){
			return $this->complemento;
		}

		public function setComplemento($complemento){
			$this->complemento = $complemento;
		}

		public function getComunidade(){
			return $this->comunidade;
		}

		public function setComunidade($comunidade){
			$this->comunidade = $comunidade;
		}

		public function getBairro(){
			return $this->bairro;
		}

		public function setBairro($bairro){
			$this->bairro = $bairro;
		}

		public function getCidade(){
			return $this->cidade;
		}

		public function setCidade($cidade){
			$this->cidade = $cidade;
		}

		public function getEstado(){
			return $this->estado;
		}

		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getCep(){
			return $this->cep;
		}

		public function setCep($cep){
			$this->cep = $cep;
		}

	}

?>