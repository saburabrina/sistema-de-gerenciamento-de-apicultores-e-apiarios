<?php

	class Quadro{
		public static int $caixa;
		public static string $tipo;
		public static string $fundo;
		public static string $material;

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
			if ($this->tipo != "") {
				return $this->tipo;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getFundo(){
			if ($this->fundo != "") {
				return $this->fundo;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getMaterial(){
			if ($this->material != "") {
				return $this->material;
			}
			else return "<strong>Sem Registro</strong>"
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