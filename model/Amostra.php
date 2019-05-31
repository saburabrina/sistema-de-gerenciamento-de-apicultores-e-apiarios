<?php

	class Amostra {
		private $controleVeterinario;
		private $tipoAbelha;
		private $materialBiologico;
		private $mel;

		function __construct($controleVeterinario, $tipoAbelha, $materialBiologico, $mel){
			$this->controleVeterinario = $controleVeterinario;
			$this->tipoAbelha = $tipoAbelha;
			$this->materialBiologico = $materialBiologico;
			$this->mel = $mel;
		}

		public function getControleVeterinario(){
			return $this->controleVeterinario;
		}

		public function setControleVeterinario($controleVeterinario){
			$this->controleVeterinario = $controleVeterinario;
		}

		public function getTipoAbelha(){
			return $this->tipoAbelha;
		}

		public function setTipoAbelha($tipoAbelha){
			$this->tipoAbelha = $tipoAbelha;
		}

		public function getMaterialBiologico(){
			return $this->materialBiologico;
		}

		public function setMaterialBiologico($materialBiologico){
			$this->materialBiologico = $materialBiologico;
		}

		public function getMel(){
			return $this->mel;
		}

		public function setMel($mel){
			$this->mel = $mel;
		}
	}

?>