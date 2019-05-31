<?php

	class Quadro{
		private static int $caixa;
		private static string $tipo;
		private static string $fundo;
		private static string $material;

		public function __construct($caixa, $tipo, $fundo, $material){
			$this->caixa = $caixa;
			$this->tipo = $tipo;
			$this->fundo = $fundo;
			$this->material = $material;
		}

		public function __destruct(){
			
		}

		# Getters and Setters
		public function getCaixa(){
			return $this->caixa;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function getFundo(){
			return $this->fundo;
		}

		public function getMaterial(){
			return $this->material;
		}

		public function setCaixa($caixa){
			$this->caixa = $caixa;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function setFundo($fundo){
			$this->fundo = $fundo;
		}

		public function setMaterial($material){
			$this->material = $material;
		}
	}

?>
