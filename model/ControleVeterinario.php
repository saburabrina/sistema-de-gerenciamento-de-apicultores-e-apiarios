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
        private $amostras;

        function __construct($id, $apiario, $data_exame, $cond_vet_geral, $nome_vet, $crmv_vet, $amostras) {
			$this->id = $id;
			$this->apiario = $apiario;
			$this->data_exame = $data_exame;
			$this->cond_vet_geral = $cond_vet_geral;
			$this->nome_vet = $nome_vet;
			$this->crmv_vet = $crmv_vet;
			$this->amostras = $amostras;
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

		public function getAmostras(){
			return $this->amostras;
		}
	
		public function setAmostras($amostras){
			$this->amostras = $amostras;
		}
	}
?>