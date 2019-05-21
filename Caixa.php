<?php
	class Caixa{
		private $id;
		private $apiario;
		private $colmeia;
        private $material;
        private $melgueira;
        private $local_extracao;
	}

	function __contruct($id, $apiario, $colmeia, $material, $melgueira, $local_extracao) {
        $this->id = $id;
		$this->apiario = $apiario;
		$this->colmeia = $colmeia;
		$this->material = $material;
		$this->melgueira = $melgueira;
		$this->local_extracao = $local_extracao;
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
?>