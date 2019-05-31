<?php
	
	class Cadastro{
		public static int $numero_cadastro;
		public static string $apicultor;
		public static string $apiario;
		public static int $propriedade;
		public static /*date */ $data;
		public static string $municipio;
		public static string $comunidade;

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
			if ($this->apicultor != "") {
				return $this->apicultor;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getApiario(){
			if ($this->apiario != "") {
				return $this->apiario;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getPropriedade(){
			return $this->propriedade;
		}

		######## data

		public function getMunicipio(){
			if ($this->municipio != "") {
				return $this->municipio;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getComunidade(){
			if ($this->comunidade != "") {
				return $this->comunidade;
			}
			else return "<strong>Sem Registro</strong>"
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

		######## data

		public function setMunicipio($municipio){
			$this->municipio = $municipio;
		}

		public function setComunidade($comunidade){
			$this->comunidade = $comunidade;
		}
	}

?>