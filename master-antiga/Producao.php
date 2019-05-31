<?php  
	class Producao {
		private static string $apiario;
		private static boolean $rotulo;
		private static string $destino;
		private static string $tipo;
		private static string $material;

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
			return $this->apiario;
		}

		public function getRotulo(){
			return $this->rotulo;
		}

		public function getDestino(){
			return $this->destino;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function getMaterial(){
			return $this->material;
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
