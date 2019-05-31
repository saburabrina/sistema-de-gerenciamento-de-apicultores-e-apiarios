<?php  
	class Producao {
		public static string $apiario;
		public static boolean $rotulo;
		public static string $destino;
		public static string $tipo;
		public static string $material;

		public function __construct($apiario, $rotulo, $destino, $tipo, $material){
			$this->apiario = $apiario;
			$this->rotulo = $rotulo;
			$this->destino = $destino;
			$this->tipo = $tipo;
			$this->material = $material;
		}

		public function __destruct(){
			
		}

		# Getters and Setters
		public function getApiario(){
			if ($this->apiario != "") {
				return $this->apiario;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getRotulo(){
			return $this->rotulo;
		}

		public function getDestino(){
			if ($this->destino != "") {
				return $this->destino;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getTipo(){
			if ($this->tipo != "") {
				return $this->tipo;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getMaterial(){
			if ($this->material != "") {
				return $this->material;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function setApiario($apiario){
			$this->apiario = $apiario;
		}

		public function setRotulo($rotulo){
			$this->rotulo = $rotulo;
		}

		public function setDestino($destino){
			$this->destino = $destino;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function setMaterial($material){
			$this->material = $material;
		}
	}
?>