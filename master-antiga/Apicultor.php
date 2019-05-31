<?php
	class Apicultor{
		private $cpf;
		private $nome;
		private $certificacao;
		private $email;
        private $telefone;
        private $producao_anual;
        private $perfil;
        private $vinculo;
        private $endereco;
        private $trabalha_em;

    
    function __contruct($cpf, $nome, $certificacao, $email, $telefone, $producao_anual, $perfil, $vinculo, $endereco, $trabalha_em) {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->certificacao = $certificacao;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->producao_anual = $producao_anual;
        $this->perfil = $perfil;
        $this->vinculo = $vinculo;
        $this->endereco = $endereco;
        $this->trabalha_em = $trabalha_em;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getCertificacao(){
        return $this->certificacao;
    }

    public function setCertificacao($nome){
        $this->certificacao = $certificacao;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getProducaoAnual(){
        return $this->producao_anual;
    }

    public function setProducaoAnual($producao_anual){
        $this->producao_anual = $producao_anual;
    }

    public function getPerfil(){
        return $this->perfil;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function getVinculo(){
        return $this->vinculo;
    }

    public function setVinculo($vinculo){
        $this->vinculo = $vinculo;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getTrabalhaEm(){
        return $this->trabalha_em;
    }

    public function setTrabalhaEm($trabalha_em){
        $this->trabalha_em = $trabalha_em;
    }

?>
