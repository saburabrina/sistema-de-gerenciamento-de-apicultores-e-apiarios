<?php
	class Fumegador{
		private $apicultor;
		private $produto_utilizado;

    	function __construct($apicultor, $produto_utilizado) {
            $this->apicultor = $apicultor;
            $this->produto_utilizado = $produto_utilizado;
    	}

    	public function getApicultor(){
            return $this->apicultor;
        }

        public function setApicultor($apicultor){
            $this->apicultor = $apicultor;
    	}
    	
    	public function getProdutoUtilizado(){
            return $this->produto_utilizado;
        }

        public function setProdutoUtilizado($produto_utilizado){
            $this->produto_utilizado = $produto_utilizado;
        }
    }
?>