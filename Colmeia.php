<?php

	class Colmeia {
		private $id;
		private $especieAbelha;
		private $origem;
		private $dataTrocaRainha;

		function __construct($id, $especieAbelha, $origem, $dataTrocaRainha){
			$this->id = $id;
			$this->especieAbelha = $especieAbelha;
			$this->origem = $origem;
			$this->dataTrocaRainha = $dataTrocaRainha;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getEspecieAbelha(){
			return $this->especieAbelha;
		}

		public function setEspecieAbelha($especieAbelha){
			$this->especieAbelha = $especieAbelha;
		}

		public function getOrigem(){
			return $this->origem;
		}

		public function setOrigem($origem){
			$this->origem = $origem;
		}

		public function getDataTrocaRainha(){
			return $this->dataTrocaRainha;
		}

		public function setDataTrocaRainha($dataTrocaRainha){
			$this->dataTrocaRainha = $dataTrocaRainha;
		}
	}

?>