<?php
	class Propriedade{
        private $id;
        private $endereco;
        private $area_destinada;

	function __contruct($id, $endereco, $area_destinada) {
        $this->id = $id;
		$this->endereco = $endereco;
		$this->area_destinada = $area_destinada;
	}

	public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
	}

	public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
	}

	public function getAreaDestinada(){
        return $this->area_destinada;
    }

    public function setAreaDestinada($area_destinada){
        $this->area_destinada = $area_destinada;
	}
}
?>