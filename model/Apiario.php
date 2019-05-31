<?php

	class Apiario {
		private $nome;
		private $dono;
		private $propriedade;
		private $inscricaoEstadual;
		private $dataFundacao;
		private $tipoFlorada;
		private $latitude;
		private $longitude;
		private $expandida;
		private $problemaSanitario;
		private $numeroCaixasPovoadas;
		private $numeroCaixasVazias;
		private $instalacao;

		function __construct($nome, $dono, $propriedade, $inscricaoEstadual, $dataFundacao, $tipoFlorada, $latitude, $longitude, $expandida, $problemaSanitario, $numeroCaixasPovoadas, $numeroCaixasVazias, $instalacao) {
			$this->nome = $nome;
			$this->dono = $dono;
			$this->propriedade = $propriedade;
			$this->inscricaoEstadual = $inscricaoEstadual;
			$this->dataFundacao = $dataFundacao;
			$this->tipoFlorada = $tipoFlorada;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->expandida = $expandida;
			$this->problemaSanitario = $problemaSanitario;
			$this->numeroCaixasPovoadas = $numeroCaixasPovoadas;
			$this->numeroCaixasVazias = $numeroCaixasVazias;
			$this->instalacao = $instalacao;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getDono(){
			return $this->dono;
		}

		public function setDono($dono){
			$this->dono = $dono;
		}

		public function getPropriedade(){
			return $this->propriedade;
		}

		public function setpropriedade($propriedade){
			$this->propriedade = $propriedade;
		}

		public function getInscricaoEstadual(){
			return $this->inscricaoEstadual;
		}

		public function setInscricaoEstadual($inscricaoEstadual){
			$this->inscricaoEstadual = $inscricaoEstadual;
		}

		public function getDataFundacao(){
			return $this->dataFundacao;
		}

		public function setDataFundacao($dataFundacao){
			$this->dataFundacao = $dataFundacao;
		}

		public function getTipoFlorada(){
			return $this->tipoFlorada;
		}

		public function setTipoFlorada($tipoFlorada){
			$this->tipoFlorada = $tipoFlorada;
		}

		public function getLatitude(){
			return $this->latitude;
		}

		public function setLatitude($latitude){
			$this->latitude = $latitude;
		}

		public function getLongitude(){
			return $this->longitude;
		}

		public function setLongitude($longitude){
			$this->longitude = $longitude;
		}

		public function getExpandida(){
			return $this->expandida;
		}

		public function setExpandida($expandida){
			$this->expandida = $expandida;
		}

		public function getProblemaSanitario(){
			return $this->problemaSanitario;
		}

		public function setProblemaSanitario($problemaSanitario){
			$this->problemaSanitario = $problemaSanitario;
		}

		public function getNumeroCaixasPovoadas(){
			return $this->numeroCaixasPovoadas;
		}

		public function setNumeroCaixasPovoadas($numeroCaixasPovoadas){
			$this->numeroCaixasPovoadas = $numeroCaixasPovoadas;
		}

		public function getNumeroCaixasVazias(){
			return $this->numeroCaixasVazias;
		}

		public function setNumeroCaixasVazias($numeroCaixasVazias){
			$this->numeroCaixasVazias = $numeroCaixasVazias;
		}

		public function getInstalacao(){
			return $this->instalacao;
		}

		public function setInstalacao($instalacao){
			$this->instalacao = $instalacao;
		}
	}

?>