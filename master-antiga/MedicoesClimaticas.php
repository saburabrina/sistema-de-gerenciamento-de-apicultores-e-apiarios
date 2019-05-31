<?php

	class MedicoesClimaticas {
		private $propriedade;
		private $data;
		private $temperatura;
		private $umidade;
		private $indicePluviometrico;

		function __construct($propriedade, $data, $temperatura, $umidade, $indicePluviometrico){
			$this->propriedade = $propriedade;
			$this->data = $data;
			$this->temperatura = $temperatura;
			$this->umidade = $umidade;
			$this->indicePluviometrico = $indicePluviometrico;
		}

		public function getPropriedade(){
			return $this->propriedade;
		}

		public function setPropriedade($propriedade){
			$this->propriedade = $propriedade;
		}

		public function getData(){
			return $this->data;
		}

		public function setData($data){
			$this->data = $data;
		}

		public function getTemperatura(){
			return $this->temperatura;
		}

		public function setTemperatura($temperatura){
			$this->temperatura = $temperatura;
		}

		public function getUmidade(){
			return $this->umidade;
		}

		public function setUmidade($umidade){
			$this->umidade = $umidade;
		}

		public function getIndicePluviometrico(){
			return $this->indicePluviometrico;
		}

		public function setIndicePluviometrico($indicePluviometrico){
			$this->indicePluviometrico = $indicePluviometrico;
		}
	}

?>
