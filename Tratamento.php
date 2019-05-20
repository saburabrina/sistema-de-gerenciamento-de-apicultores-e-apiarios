<?php
	
	class Tratamento {
		public static int $colmeia;
		public static int $quantidade_doses;
		public static string $forma_dosagem;
		public static string $doenca;
		public static string $produto;
		public static /* date */ $data_tratamento;
		public static string $nome_veterinario;
		public static string $crmv_veterinario;

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
			if ($this->forma_dosagem != "") {
				return $this->forma_dosagem;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getDoenca(){
			if ($this->doenca != "") {
				return $this->doenca;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getProduto(){
			if ($this->produto != "") {
				return $this->produto;
			}
			else return "<strong>Sem Registro</strong>"
		}

		######## data_tratamento

		public function getNomeVeterinario(){
			if ($this->nome_veterinario != "") {
				return $this->nome_veterinario;
			}
			else return "<strong>Sem Registro</strong>"
		}

		public function getCRMVVeterinario(){
			if ($this->crmv_veterinario != "") {
				return $this->crmv_veterinario;
			}
			else return "<strong>Sem Registro</strong>"
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

		######## data_tratamento

		public function setNomeVeterinario($nome_veterinario){
			$this->nome_veterinario = $nome_veterinario;
		}

		public function setCRMVVeterinario($crmv_veterinario){
			$this->crmv_veterinario = $crmv_veterinario;
		}
	}

?>