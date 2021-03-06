<?php
	
	class Tratamento {
		private static int $colmeia;
		private static int $quantidade_doses;
		private static string $forma_dosagem;
		private static string $doenca;
		private static string $produto;
		private static string $data_tratamento; # date
		private static string $nome_veterinario;
		private static string $crmv_veterinario;

		public function __construct($colmeia, $quantidade_doses, $forma_dosagem, $doenca, $produto, $data_tratamento, $nome_veterinario, $crmv_veterinario){
			$this->colmeia = $colmeia;
			$this->quantidade_doses = $quantidade_doses;
			$this->forma_dosagem = $forma_dosagem;
			$this->doenca = $doenca;
			$this->produto = $produto;
			$this->data_tratamento = $data_tratamento;
			$this->nome_veterinario = $nome_veterinario;
			$this->crmv_veterinario = $crmv_veterinario;
		}

		public function __destruct(){
			
		}

		# Getters and Setters
		public function getColmeia(){
			return $this->colmeia;
		}

		public function getQuantidadeDoses(){
			return $this->quantidade_doses;
		}

		public function getFormaDosagem(){
			return $this->forma_dosagem;
		}

		public function getDoenca(){
			return $this->doenca;
		}

		public function getProduto(){
			return $this->produto;
		}

		public function getDataTratamento(){
			return $this->data_tratamento;
		}

		public function getNomeVeterinario(){
			return $this->nome_veterinario;
		}

		public function getCRMVVeterinario(){
			return $this->crmv_veterinario;
		}

		public function setColmeia($colmeia){
			$this->colmeia = $colmeia;
		}

		public function setQuantidadeDoses($quantidade_doses){
			$this->quantidade_doses = $quantidade_doses;
		}

		public function setFormaDosagem($forma_dosagem){
			$this->forma_dosagem = $forma_dosagem;
		}

		public function setDoenca($doenca){
			$this->doenca = $doenca;
		}

		public function setProduto($produto){
			$this->produto = $produto;
		}

		public function setDataTratamento($data_tratamento){
			$this->data_tratamento = $data_tratamento;
		}

		public function setNomeVeterinario($nome_veterinario){
			$this->nome_veterinario = $nome_veterinario;
		}

		public function setCRMVVeterinario($crmv_veterinario){
			$this->crmv_veterinario = $crmv_veterinario;
		}
	}

?>
