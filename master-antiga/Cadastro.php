<?php
	
	class Cadastro{
		private static int $numero_cadastro;
		private static string $apicultor;
		private static string $apiario;
		private static int $propriedade;
		private static string $data; # date
		private static string $municipio;
		private static string $comunidade;

		public function __construct($numero_cadastro, $apicultor, $apiario, $propriedade, $data, $municipio, $comunidade){
			$this->numero_cadastro = $numero_cadastro;
			$this->apicultor = $apicultor;
			$this->apiario = $apiario;
			$this->propriedade = $propriedade;
			$this->data = $data;
			$this->municipio = $municipio;
			$this->comunidade = $comunidade;
		}

		public function __destruct(){

		}

		# Getters and Setters
		public function getNumeroCadastro(){
			return $this->numero_cadastro;
		}

		public function getApicultor(){
			return $this->apicultor;
		}

		public function getApiario(){
			return $this->apiario;
		}

		public function getPropriedade(){
			return $this->propriedade;
		}

		public function getData(){
			return $this->data;
		}

		public function getMunicipio(){
			return $this->municipio;
		}

		public function getComunidade(){
			return $this->comunidade;
		}

		public function setNumeroCadastro($numero_cadastro){
			$this->numero_cadastro = $numero_cadastro;
		}

		public function setApicultor($apicultor){
			$this->apicultor = $apicultor;
		}

		public function setApiario($apiario){
			$this->apiario = $apiario;
		}

		public function setPropriedade($propriedade){
			$this->propriedade = $propriedade;
		}

		public function setData($data){
			$this->data = $data;
		}
		public function setMunicipio($municipio){
			$this->municipio = $municipio;
		}

		public function setComunidade($comunidade){
			$this->comunidade = $comunidade;
		}
	}

?>
