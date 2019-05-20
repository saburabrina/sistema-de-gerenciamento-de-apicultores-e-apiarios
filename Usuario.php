<?php

	require_once('DataGetter.php');
	require_once('Apicultor.php');

	class Usuario {
		private $nome;
		private $cpf;
		private $email;
		private $senha;
	}

	function __construct($nome, $cpf, $email, $senha){
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->email = $email;
		$this->senha = $senha;
	}

	public function cadastrarApiario($nome, $dono, $propriedade, $inscricaoEstadual, $dataFundacao, $tipoFlorada, $latitude, $longitude, $expandida, $problemaSanitario, $numeroCaixasPovoadas, $numeroCaixasVazias, $instalacao){

		$sql = 'INSERT INTO APIARIO VALUES ("'. $nome . '", "' . $dono . '", ' . $propriedade . ', "' . $inscricaoEstadual . '", "' . $dataFundacao . '", "' . $tipoFlorada . '", ' . $latitude . ', ' . $longitude . ', ' . $expandida . ', ' . $problemaSanitario . ', ' . $numeroCaixasPovoadas . ', ' . $numeroCaixasVazias . ', "' . $instalacao . '")'; 
		DataGetter::getConn()->exec($sql);
	}

	public function cadastrarFumegador($apicultor, $produtoUtilizado){
		$sql = 'INSERT INTO FUMEGADOR VALUES ("' . $apicultor . '", ' . $produtoUtilizado . '")';
		DataGetter::getConn()->exec($sql);
	}

	public function cadastrarTratamento($colmeia, $quantidadeDoses, $formaDosagem, $doenca, $produto, $dataTratamento, $nomeVeterinario, $crmvVeterinario){
		$sql = 'INSERT INTO TRATAMENTO VALUES (' . $colmeia . ', ' . $quantidadeDoses . ',"' . $formaDosagem . '", "' . $doenca . '", "' . $produto . '", "' . $dataTratamento . '", "' . $nomeVeterinario . '", "' . $crmvVeterinario . '")';
		DataGetter::getConn()->exec($sql);
	}

	public function recuperarApiarios(){
		$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, CONCAT(APIARIO.dono, '-', APICULTOR.nome) as dono, CONCAT(ENDERECO.logradouro, ',', ENDERECO.numero, ',', ENDERECO.complemento, ',', ENDERECO.comunidade, ',', ENDERECO.bairro, ',', ENDERECO.cidade, ',', ENDERECO.estado, ',', ENDERECO.cep) as endereco, APIARIO.inscricao_estadual as inscricao_estadual, APIARIO.data_fundacao as data_fundacao, APIARIO.tipo_florada as tipo_florada, APIARIO.latitude as latitude, APIARIO.longitude as longitude, APIARIO.expandida as expandida, APIARIO.problema_sanitario as problema_sanitario, APIARIO.num_caixas_povoadas as num_caixas_povoadas, APIARIO.num_caixas_vazias as num_caixas_vazias, APIARIO.tipo_instalacao as tipo_instalacao FROM APIARIO, APICULTOR, PROPRIEDADE, ENDERECO WHERE APIARIO.propriedade = PROPRIEDADE.id AND PROPRIEDADE.endereco = ENDERECO.id");
		$stmt->execute();

		$apiarios = array();
		while($apiario = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apiarios, new Apiario($apiario['nome'], $apiario['dono'], $apiario['endereco'], $apiario['inscricao_estadual'], $apiario['data_fundacao'], $apiario['tipo_florada'], $apiario['latitude'], $apiario['logintude'], $apiario['expandida'], $apiario['problema_sanitario'], $apiario['num_caixas_povoadas'], $apiario['num_caixas_vazias'], $apiario['tipo_instalacao']));
		}

		return $apiarios;
	}

	/*public function recuperarApicultores(){
		$stmt = DataGetter::getConn()->prepare("SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificacao as certificao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.producao_anual as producao_anual, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, CONCAT(ENDERECO.logradouro, ',', ENDERECO.numero, ',', ENDERECO.complemento, ',', ENDERECO.comunidade, ',', ENDERECO.bairro, ',', ENDERECO.cidade, ',', ENDERECO.estado, ',', ENDERECO.cep) as endereco, CONCAT(ENDERECO.logradouro, ',', ENDERECO.numero, ',', ENDERECO.complemento, ',', ENDERECO.comunidade, ',', ENDERECO.bairro, ',', ENDERECO.cidade, ',', ENDERECO.estado, ',', ENDERECO.cep) as localTrabalho FROM APICULTOR, PROPRIEDADE, ENDERECO WHERE APICULTOR.endereco = ENDERECO.id AND APICULTOR.trabalha_em = PROPRIEDADE.id AND PROPRIEDADE.endereco = (SELECT id FROM ENDERECO)");
		$stmt->execute();

		$apicultores = array();
		while($apicultor = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], $apicultor['certificacao'], $apicultor['email'], $apicultor['telefone'], $apicultor['producao_anual'], $apicultor['perfil'], $apicultor['vinculo'], $apicultor['endereco'], $apicultor['trabalha_em']));
		}

		return $apicultores;
	}*/

	public function recuperarApiariosPorApicultor($apicultor) {
		$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, APIARIO.dono as dono, APICULTOR.nome as nomeDono, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, APIARIO.inscricao_estadual as inscricao_estadual, APIARIO.data_fundacao as data_fundacao, APIARIO.tipo_florada as tipo_florada, APIARIO.latitude as latitude, APIARIO.longitude as longitude, APIARIO.expandida as expandida, APIARIO.problema_sanitario as problema_sanitario, APIARIO.num_caixas_povoadas as num_caixas_povoadas, APIARIO.num_caixas_vazias as num_caixas_vazias, APIARIO.tipo_instalacao as tipo_instalacao FROM APIARIO, APICULTOR, PROPRIEDADE, ENDERECO GROUP BY APICULTOR.cpf HAVING APICULTOR.cpf = APIARIO.dono AND APICULTOR.cpf = " . $apicultor->getCpf());

		$stmt->execute();

		$apiarios = array();
		while($apiario = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apiarios, new Apiario($apiario['nome'], new Apicultor($apiario['dono'], $apiario['nomeDono'], null, null, null, null, null, null, null, null, null), new Endereco($apiario['id'], $apiario['logradouro'], $apiario['numero'], $apiario['complemento'], $apiario['comunidade'], $apiario['bairro'], $apiario['cidade'], $apiario['estado'], $apiario['cep']), $apiario['inscricao_estadual'], $apiario['data_fundacao'], $apiario['tipo_florada'], $apiario['latitude'], $apiario['logintude'], $apiario['expandida'], $apiario['problema_sanitario'], $apiario['num_caixas_povoadas'], $apiario['num_caixas_vazias'], $apiario['tipo_instalacao']));
		}

		return $apiarios;
	}

	public function recuperarEnderecoApicultor($apicultor){
		$stmt = DataGetter::getConn()->prepare("SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE APICULTOR.cpf =" . $apicultor->getCpf() . " AND APICULTOR.endereco = ENDERECO.id");

		$stmt->execute();

		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$endereco = new Endereco($resultado['id'], $resultado['logradouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep']);

		return $endereco;
	}

	public function recuperarCaixasPorApicultor($apicultor){
		$stmt = DataGetter::getConn()->prepare("SELECT CAIXA.id as id, CAIXA.apiario as apiario, CAIXA.material as material, CAIXA.melgueiras as melgueiras, CAIXA.local_extracao as local_extracao FROM CAIXA, APIARIO, APICULTOR WHERE CAIXA.apiario = APIARIO.nome AND APIARIO.dono = " . $apicultor);

		$stmt->execute();

		$caixas = array();
		while($caixa = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($caixas, new Caixa($caixa['id'], $caixa['apiario'], null, $caixa['material'], $caixa['melgueiras'], $caixa['local_extracao']));
		}

		return $caixas;
	}

	public function recuperarContatoApicultor($apicultor){
		$stmt = DataGetter::getConn()->prepare("SELECT nome, telefone, email FROM APICULTOR WHERE cpf = " . $apicultor->getCpf());

		$stmt->execute();

		$contato = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $contato;
	}

	public function recuperarFumegadores($apicultor){
		$stmt = DataGetter::getConn()->prepare("SELECT * FROM FUMEGADOR WHERE apicultor = " . $apicultor->getCpf());

		$stmt->execute();

		$fumegadores = array();
		while($fumegador = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($fumegadores, new Fumegador($fumegador['apicultor'], $fumegador['produto_utilizado']));
		}

		return $fumegadores;
	}

	public function recuperarProducaoMel($apicultor, $ano){
		$stmt = DataGetter::getConn()->prepare("SELECT producao FROM PRODUCAO_ANUAL WHERE apicultor = " . $apicultor->getCpf() . " AND ano = " . $ano);

		$stmt->execute();

		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $resultado['producao'];	
	}

	public function recuperaApicultoresProducaoAnualMel($ano) {
		$stmt = DataGetter::getConn()->prepare("SELECT cpf, nome FROM APICULTOR WHERE cpf = (SELECT apicultor FROM PRODUCAO_ANUAL WHERE ano = " . $ano . ")");

		$stmt->execute();

		$apicultores = array();
		while($apicultor = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apicultores, new new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, null, null, null);
		}

		return $apicultores;
	}

	public function recuperarPropriedadesPorApicultor($apicultor){
		$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.id = (SELECT propriedade FROM CADASTRO WHERE apicultor = " . $apicultor->getCpf() . ") AND PROPRIEDADE.endereco = ENDERECO.id");

		$stmt->execute();

		$propriedades = array();
		while($propriedade = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($propriedades, new new Propriedade($propriedade['id'], new Endereco($apiario['id'], $apiario['logradouro'], $apiario['numero'], $apiario['complemento'], $apiario['comunidade'], $apiario['bairro'], $apiario['cidade'], $apiario['estado'], $apiario['cep']), $propriedade['area_destinada']);
		}

		return $propriedades;	
	}

	public function recuperarDonosDePropriedade(){
		$stmt = DataGetter::getConn()->prepare('SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificao as certificacao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.producao_anual as producao_anual, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE vinculo LIKE "%Própria%"');

		$stmt->execute();

		$apicultores = array();
		while($apicultor = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], $apicultor['certificacao'], $apicultor['email'], $apicultor['telefone'], $apicultor['producao_anual'], $apicultor['perfil'], $apicultor['vinculo'], new Endereco($apicultor['id'], $apicultor['logradouro'], $apicultor['numero'], $apicultor['complemento'], $apicultor['comunidade'], $apicultor['bairro'], $apicultor['cidade'], $apicultor['estado'], $apicultor['cep']), null));
		}

		$stmt = DataGetter::getConn()->prepare('SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM ENDERECO WHERE ENDERECO.id = (SELECT endereco FROM PROPRIEDADE WHERE id = (SELECT trabalha_em FROM APICULTOR WHERE vinculo LIKE "%Própria%"))');

		$stmt->execute();
		$propriedades = array();
		while($propriedade = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($propriedades, new Endereco($propriedade['id'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']));
		}

		for($i=0; $i<count($apicultores); $i++){
			$apicultores[$i]->setTrabalhaEm($propriedades[$i]);
		}


		return $apicultores;
	}

	public function recuperarVinculo($apicultor){
		$stmt = DataGetter::getConn()->prepare('SELECT cpf, nome, vinculo FROM APICULTOR GROUP BY vinculo WHERE cpf = ' . $apicultor->getCpf());

		$stmt->execute();

		$apicultores = array();
		while($apicultor = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, $apicultor['vinculo'], null, null));
		}

		return $apicultores;
	}

	public function recuperarTiposAbelhaPorApicultor($apicultor){
		$stmt = DataGetter::getConn()->prepare('SELECT especie_abelha FROM COLMEIA WHERE id = (SELECT colmeia FROM CAIXA WHERE apiario = (SELECT nome FROM APIARIO WHERE dono = ' . $apicultor->getCpf() '))');

		$stmt->execute();

		$tipos = array();
		while($tipo = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($tipos, $tipo);
		}

		return $tipos;
	}

	public function recuperarPropriedades(){
		$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.endereco = ENDERECO.id");

		$stmt->execute();

		$propriedades = array();
		while($propriedade = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
		}

		return $propriedades;
	}

	public function recuperarCaixasPorApiario($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT CAIXA.id as id, CAIXA.apiario as apiario, CAIXA.material as material, CAIXA.melgueiras as melgueiras, CAIXA.local_extracao as local_extracao FROM CAIXA WHERE CAIXA.apiario = " . $apiario->getCpf());

		$stmt->execute();

		$caixas = array();
		while($caixa = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($caixas, new Caixa($caixa['id'], $caixa['apiario'], null, $caixa['material'], $caixa['melgueiras'], $caixa['local_extracao']));
		}

		return $caixas;
	}

	public function recuperarTipoFlorada($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT tipo_florada FROM APIARIO WHERE nome =" . $apiario->getCpf());

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $resultado['tipo_florada'];	
	}

	public function recuperarCoordenada($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT latitude, longitude FROM APIARIO WHERE nome =" . $apiario->getCpf());

		$stmt->execute();

		$coordenada = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $coordenada;
	}

	public function recuperarAreaDestinada($endereço){
		$stmt = DataGetter::getConn()->prepare("SELECT area_destinada FROM PROPRIEDADE WHERE PROPRIEDADE.endereco = (SELECT id FROM ENDERECO WHERE cep = " . $endereco->getCep() . " AND numero = " . $endereco->getNumero() . ")");

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $resultado['area_destinada'];
	}

	public function recuperarPropriedadePorApiario($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as idE, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.id = (SELECT propriedade FROM APIARIO WHERE nome = " . $apiario->getNome() . ")");

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$propriedade = new Propriedade($resultado['id'], new Endereco($resultado['id'], $resultado['logradouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep']), $resultado['area_destinada']);
		
		return $propriedade;
	}

	public function recuperarEnderecoPropriedade($propriedade){
		$stmt = DataGetter::getConn()->prepare("SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM ENDERECO WHERE ENDERECO.id = (SELECT endereco FROM PROPRIEDADE WHERE endereco = " . $propriedade->getEndereco()->getId() . ")");

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$endereco = new Endereco($resultado['id'], $resultado['lograouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep'])

		return $endereco;
	}

	public function recuperarApicultoresPorPropriedade($propriedade){
		$stmt = DataGetter::getConn()->prepare("SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.trabalha_em as trabalha_em FROM APICULTOR, PROPRIEDADE GROUP BY trabalha_em HAVING trabalha_em = " . $propriedade->getId());

		$stmt->execute();

		$apicultores = array();
		while($apicultor = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, null, null, null));
		}

		return $apicultores;
	}

	public function recuperarMesesChuvososPorPropriedade($propriedade){
		$stmt = DataGetter::getConn()->prepare("SELECT data, MAX(indice_pluviometrico) as indice_pluviometrico FROM MEDICOES_CLIMATICAS	WHERE propriedade = " . $propriedade->getId());

		$stmt->execute();

		$medicoes = array();
		while($medicao = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($medicoes, new MedicoesClimaticas($propriedade, $medicao['data'], null, null, $medicao['indice_pluviometrico']));
		}

		return $medicoes;
	}

	public function recuperarInformacoesClimaticas($ano, $propriedade){
		$stmt = DataGetter()->getConn()->prepare("SELECT temperatura, umidade_ar FROM MEDICOES_CLIMATICAS WHERE data LIKE '%/" . $ano "' AND propriedade = " . $propriedade->getId());

		$stmt->execute();

		$medicoes = array();
		while($medicao = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($medicoes, new MedicoesClimaticas($propriedade, null, $medicao['temperatura'], $medicao['umidade_ar'], null));
		}

		return $medicoes;
	}

	public function recuperarInscricaoEstadual($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT inscricao_estadual FROM APIARIO WHERE nome = " . $apiario->getNome());

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $resultado['inscricao_estadual'];
	}

	public function apiarioPossuiLocalProducao($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, APIARIO.dono as dono FROM APIARIO LEFT JOIN PRODUCAO ON nome = PRODUCAO.apiario WHERE PRODUCAO.apiario IS NULL AND nome = " . $apiario->getNome());

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return count($resultado);

	}

	public function recuperarTiposAbelhaPorApiario($apiario){
		$stmt = DataGetter::getConn()->prepare('SELECT especie_abelha FROM COLMEIA WHERE id = (SELECT colmeia FROM CAIXA WHERE apiario = ' . $apiario->getNome() . ')');

		$stmt->execute();

		$tipos = array();
		while($tipo = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($tipos, $tipo);
		}

		return $tipos;
	}

	public function recuperarApiarioPossuemLocalProducao(){
		$stmt = DataGetter::getConn()->prepare("SELECT DISTINCT apiario FROM PRODUCAO");

		$apiarios = array();
		while($apiario = $stmt->setFetchMode(PDO::FETCH_ASSOC)){
			array_push($apiarios, $apiario['apiario']);
		}

		return $apiarios;
	}

	public function recuperarMaterialProducao($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT DISTINCT material FROM PRODUCAO WHERE apiario = " . $apiario->getNome());

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $resultado['material'];
	}

	public function recuperarDestinoProducao($apiario){
		$stmt = DataGetter::getConn()->prepare("SELECT destino FROM PRODUCAO WHERE apiario = " . $apiario->getNome());

		$stmt->execute();
		$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $resultado['destino'];
	}

?>