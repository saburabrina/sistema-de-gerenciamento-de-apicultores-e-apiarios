<?php
	class ControleVeterinario{
		private $id;
		private $apiario;
		private $data_exame;
		private $cond_vet_geral;
        private $nome_vet;
        private $crmv_vet;
        private $tipo_abelha;
        private $material_biologico;
		private $mel;
		
		function __contruct($id, $apiario, $data_exame, $cond_vet_geral, $nome_vet, $crmv_vet, $tipo_abelha, $material_biologico, $mel) {
			$this->id = $id;
			$this->apiario = $apiario;
			$this->data_exame = $data_exame;
			$this->cond_vet_geral = $cond_vet_geral;
			$this->nome_vet = $nome_vet;
			$this->crmv_vet = $crmv_vet;
			$this->tipo_abelha = $tipo_abelha;
			$this->material_biologico = $material_biologico;
			$this->mel = $mel;
		}

		public function getId(){
			return $this->id;
		}
	
		public function setId($id){
			$this->id = $id;
		}

		public function getApiario(){
			return $this->apiario;
		}
	
		public function setApiario($apiario){
			$this->apiario = $apiario;
		}

		public function getDataExame(){
			return $this->data_exame;
		}
	
		public function setDataExame($data_exame){
			$this->data_exame = $data_exame;
		}

		public function getCondVetGeral(){
			return $this->cond_vet_geral;
		}
	
		public function setCondVetGeral($cond_vet_geral){
			$this->cond_vet_geral = $cond_vet_geral;
		}

		public function getNomeVet(){
			return $this->nome_vet;
		}
	
		public function setNomeVet($nome_vet){
			$this->nome_vet = $nome_vet;
		}

		public function getCRMVVet(){
			return $this->crmv_vet;
		}
	
		public function setCRMVVet($crmv_vet){
			$this->crmv_vet = $crmv_vet;
		}

		public function getTipoAbelha(){
			return $this->tipo_abelha;
		}
	
		public function setTipoAbelha($tipo_abelha){
			$this->tipo_abelha = $tipo_abelha;
		}

		public function getMaterialBiologico(){
			return $this->material_biologico;
		}
	
		public function setMaterialBiologico($material_biologico){
			$this->material_biologico = $material_biologico;
		}

		public function getMel(){
			return $this->mel;
		}
	
		public function setMel($mel){
			$this->mel = $mel;
		}
	}
?>