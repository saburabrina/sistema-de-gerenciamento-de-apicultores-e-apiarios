<?php

	class ProducaoAnual {
		private $ano;
		private $apicultor;
		private $valor_da_producao;

		function __construct($ano, $apicultor, $valor_da_producao){
			$this->ano = $ano;
			$this->apicultor = $apicultor;
			$this->valor_da_producao = $valor_da_producao;
		}

		public function getAno(){
			return $this->ano;
		}

		public function setAno($ano){
			$this->ano = $ano;
		}

		public function getApicultor(){
			return $this->apicultor;
		}

		public function setApicultor($apicultor){
			$this->apicultor = $apicultor;
		}

		public function getValorDaProducao(){
			return $this->valor_da_producao;
		}

		public function setValorDaProducao($valor_da_producao){
			$this->valor_da_producao = $valor_da_producao;
		}
	}

?>