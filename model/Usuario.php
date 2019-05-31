<?php
	require_once('DataGetter.php');
	require_once('Apicultor.php');
	require_once('Apiario.php');
	require_once('Amostra.php');
	require_once('Caixa.php');
	require_once('Colmeia.php');
	require_once('Endereco.php');
	require_once('Fumegador.php');
	require_once('MedicoesClimaticas.php');
	require_once('Propriedade.php');

	class Usuario {
		private $nome;
		private $cpf;
		private $email;
		private $senha;

		function __construct($nome, $cpf, $email, $senha){
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->senha = $senha;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getCpf(){
			return $this->cpf;
		}

		public function setCpf($cpf){
			$this->cpf = $cpf;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function efetuarLogin($cpf, $senha){
			$sql = 'SELECT nome, cpf, email, senha FROM USUARIO WHERE cpf = "' . $cpf . '"';
			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$resultado){
				return null;
			} else if($resultado['senha'] != $senha){
				return new Usuario(null, $cpf, null, null);
			} else {
				return new Usuario($resultado['nome'], $cpf, $resultado['email'], $senha);
			}
		}

		public function cadastrarApiario($nome, $dono, $propriedade, $inscricaoEstadual, $dataFundacao, $tipoFlorada, $latitude, $longitude, $expandida, $problemaSanitario, $numeroCaixasPovoadas, $numeroCaixasVazias, $instalacao){

			$sql = 'INSERT INTO APIARIO VALUES ("'. $nome . '", "' . $dono . '", ' . $propriedade . ', "' . $inscricaoEstadual . '", "' . $dataFundacao . '", "' . $tipoFlorada . '", ' . $latitude . ', ' . $longitude . ', ' . $expandida . ', ' . $problemaSanitario . ', ' . $numeroCaixasPovoadas . ', ' . $numeroCaixasVazias . ', "' . $instalacao . '")'; 


			$stmt = DataGetter::getConn()->prepare($sql);
			
			if($stmt->execute()){
				return True;
			} else {
				return False;
			}
		}

		public function cadastrarApicultor($nome, $cpf, $telefone, $email, $logradouro, $numero, $complemento, $bairro, $comunidade, $cidade, $estado, $cep, $perfil, $certificacao, $vinculo, $logradouroPropriedade, $numeroPropriedade, $complementoPropriedade, $bairroPropriedade, $comunidadePropriedade, $cidadePropriedade, $estadoPropriedade, $cepPropriedade) {

			$sql = 'SELECT id FROM PROPRIEDADE WHERE endereco = (SELECT id FROM ENDERECO WHERE';

			$jaTem = False;

			if($logradouroPropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.logradouro = "' . $logradouroPropriedade . '"';
				} else {
					$sql .= ' ENDERECO.logradouro = "' . $logradouroPropriedade . '"';
					$jaTem = True;
				}
			}

			if($numeroPropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.numero = ' . $numeroPropriedade;
				} else {
					$sql .= ' ENDERECO.numero = ' . $numeroPropriedade;
					$jaTem = True;
				}
			}

			if($complementoPropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.complemento = "' . $complementoPropriedade . '"';
				} else {
					$sql .= ' ENDERECO.complemento = "' . $complementoPropriedade . '"';
					$jaTem = True;
				}
			}

			if($comunidadePropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.comunidade = "' . $comunidadePropriedade . '"';
				} else {
					$sql .= ' ENDERECO.comunidade = "' . $comunidadePropriedade . '"';
					$jaTem = True;
				}
			}

			if($cidadePropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.cidade = "' . $cidadePropriedade . '"';
				} else {
					$sql .= ' ENDERECO.cidade = "' . $cidadePropriedade . '"';
					$jaTem = True;
				}
			}

			if($estadoPropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.estado = "' . $estadoPropriedade . '"';
				} else {
					$sql .= ' ENDERECO.estado = "' . $estadoPropriedade . '"';
					$jaTem = True;
				}
			}

			if($cepPropriedade != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.cep = "' . $cepPropriedade . '"';
				} else {
					$sql .= ' ENDERECO.cep = "' . $cepPropriedade . '"';
					$jaTem = True;
				}
			}

			$sql .= ')';

			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();
			$trabalha_em = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!$trabalha_em){
				return -1;
			}

			/*if(!$trabalha_em){
				$sql = 'INSERT INTO ENDERECO (cep, cidade, estado, bairro, logradouro, numero, complemento, comunidade)VALUES("' . $cepPropriedade . '","' . $cidadePropriedade . '","' . $estadoPropriedade . '","' . $bairroPropriedade . '","' . $logradouroPropriedade . '",' . $numeroPropriedade . ',"' . $complementoPropriedade . '","' . $comunidadePropriedade . '")';

				echo $sql;

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				$sql = 'SELECT id FROM PROPRIEDADE WHERE endereco = (SELECT id FROM ENDERECO WHERE logradouro="' . $logradouroPropriedade . '" AND numero=' . $numeroPropriedade . ' AND complemento="' . $complementoPropriedade . '" AND bairro="' . $bairroPropriedade . '" AND comunidade="' . $comunidadePropriedade . '" AND cidade="' . $cidadePropriedade . '" AND estado="' . $estadoPropriedade . '" AND cep="' . $cepPropriedade . '")';

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();
				$trabalha_em = $stmt->fetch(PDO::FETCH_ASSOC);
			}*/

			$sql = 'SELECT id FROM ENDERECO WHERE logradouro="' . $logradouro . '" AND numero=' . $numero . ' AND complemento="' . $complemento . '" AND bairro="' . $bairro . '" AND comunidade="' . $comunidade . '" AND cidade="' . $cidade . '" AND estado="' . $estado . '" AND cep="' . $cep . '"';

			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();
			$endereco = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!$endereco){
				$sql = 'INSERT INTO ENDERECO (cep, cidade, estado, bairro, logradouro, numero, complemento, comunidade)VALUES("' . $cep . '","' . $cidade . '","' . $estado . '","' . $bairro . '","' . $logradouro . '",' . $numero . ',"' . $complemento . '","' . $comunidade . '")';
				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				$sql = 'SELECT id FROM ENDERECO WHERE logradouro="' . $logradouro . '" AND numero=' . $numero . ' AND complemento="' . $complemento . '" AND bairro="' . $bairro . '" AND comunidade="' . $comunidade . '" AND cidade="' . $cidade . '" AND estado="' . $estado . '" AND cep="' . $cep . '"';

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();
				$endereco = $stmt->fetch(PDO::FETCH_ASSOC);

				echo $endereco;
			}			

			$sql = 'INSERT INTO APICULTOR VALUES ("' . $cpf . '","' . $nome . '","' . $certificacao . '","' . $email . '","' . $telefone . '",' . $endereco['id'] . ',"' . $perfil . '","' . $vinculo . '",' . $trabalha_em['id'] . ')';
			
			echo $sql;
			$stmt = DataGetter::getConn()->prepare($sql);
			
			if($stmt->execute()){
				return True;
			} else {
				return False;
			}
		}

		public function editarApicultor($apicultor){

			$sql = "UPDATE APICULTOR SET nome = '" . $apicultor->getNome() . "', certificacao = '" . $apicultor->getCertificacao() . "', email = '" . $apicultor->getEmail() . "', telefone = '" . $apicultor->getTelefone() . "', perfil = '" . $apicultor->getPerfil() . "', vinculo = '" . $apicultor->getVinculo() . "' WHERE cpf = '" . $apicultor->getCpf() . "'";

			$contador = 0;

			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$contador += 1;
			}

			$sql = "UPDATE ENDRECO SET logradouro = '" . $apicultor->getEndereco()->getLogradouro() . "', numero = " . $apicultor->getEndereco()->getNumero() . ", complemento = '" .$apicultor->getEndereco()->getComplemento() . "', bairro = '" . $apicultor->getEndereco()->getBairro() . "', comunidade = '" . $apicultor->getEndereco()->getComunidade() . "', cidade = '" . $apicultor->getEndereco()->getCidade() . "', estado = '" . $apicultor->getEndereco()->getEstado() . "', cep = '" . $apicultor->getEndereco()->getCep() . " WHERE id = " . $apicultor->getEndereco()->getId();

			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$contador += 1;
			}			

			if ($contador == 2) {
				return true;
			}
			return false;
		}

		public function cadastrarFumegador($apicultor, $produtoUtilizado){
			$sql = 'INSERT INTO FUMEGADOR VALUES ("' . $apicultor . '", "' . $produtoUtilizado . '")';
			$stmt = DataGetter::getConn()->prepare($sql);
			
			if($stmt->execute()){
				return True;
			} else {
				return False;
			}
		}

		public function cadastrarTratamento($colmeia, $quantidadeDoses, $formaDosagem, $doenca, $produto, $dataTratamento, $nomeVeterinario, $crmvVeterinario){
			$sql = 'INSERT INTO TRATAMENTO VALUES (' . $colmeia . ', ' . $quantidadeDoses . ',"' . $formaDosagem . '", "' . $doenca . '", "' . $produto . '", "' . $dataTratamento . '", "' . $nomeVeterinario . '", "' . $crmvVeterinario . '")';
			DataGetter::getConn()->exec($sql);
		}

		public function recuperarApiarios($filtros){

			if(count($filtros) > 0){

				$sql = "SELECT APIARIO.*, ENDERECO.* FROM APIARIO, ENDERECO, PROPRIEDADE WHERE APIARIO.propriedade = PROPRIEDADE.id AND PROPRIEDADE.endereco = ENDERECO.id AND ";

				$jaTem = False;

				if($filtros['nome'] != ''){
					$sql .= 'APIARIO.nome LIKE "%' . $filtros['nome'] . '%"';
				}

				if($filtros['dono'] != ''){
					if($jaTem){
						$sql .= ' AND APIARIO.dono = "' . $filtros['dono'] . '"';
					} else {
						$sql .= ' APIARIO.dono = "' . $filtros['dono'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['inscricao_estadual'] != ''){
					if($jaTem){
						$sql .= ' AND APIARIO.inscricao_estadual = "' . $filtros['inscricao_estadual'] . '"';
					} else {
						$sql .= ' APIARIO.inscricao_estadual = "' . $filtros['inscricao_estadual'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['data_fundacao'] != ''){

					if($jaTem){
						$sql .= ' AND APIARIO.data_fundacao = "' . $filtros['data_fundacao'] . '"';
					} else {
						$sql .= ' APIARIO.data_fundacao = "' . $filtros['data_fundacao'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['latitude'] != ''){
					if($jaTem){
						$sql .= ' AND APIARIO.latitude = ' . $filtros['latitude'];
					} else {
						$sql .= ' APIARIO.latitude = ' . $filtros['latitude'];
						$jaTem = True;
					}
				}

				if($filtros['longitude'] != ''){
					if($jaTem){
						$sql .= ' AND APIARIO.longitude = ' . $filtros['longitude'];
					} else {
						$sql .= ' APIARIO.longitude = ' . $filtros['longitude'];
						$jaTem = True;
					}
				}

				if($filtros['tipo_instalacao'] != ''){
					if($jaTem){
						$sql .= ' AND APIARIO.tipo_instalacao = "' . $filtros['tipo_instalacao'] . '"';
					} else {
						$sql .= ' APIARIO.tipo_instalacao = "' . $filtros['tipo_instalacao'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['logradouro'] != '' || $filtros['numero'] != '' || $filtros['complemento'] != '' || $filtros['bairro'] != '' || $filtros['comunidade'] != '' || $filtros['cidade'] != '' || $filtros['estado'] != '' || $filtros['cep'] != ''){

					if($filtros['logradouro'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.logradouro LIKE "%' . $filtros['logradouro'] . '%"';
						} else {
							$sql .= ' ENDERECO.logradouro LIKE "%' . $filtros['logradouro'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['numero'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.numero = "' . $filtros['numero'] . '"';
						} else {
							$sql .= ' ENDERECO.numero = "' . $filtros['numero'] . '"';
							$jaTem = True;
						}
					}

					if($filtros['complemento'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.complemento LIKE "%' . $filtros['complemento'] . '%"';
						} else {
							$sql .= ' ENDERECO.complemento LIKE "%' . $filtros['complemento'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['comunidade'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.comunidade LIKE "%' . $filtros['comunidade'] . '%"';
						} else {
							$sql .= ' ENDERECO.comunidade LIKE "%' . $filtros['comunidade'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['bairro'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.bairro LIKE "%' . $filtros['bairro'] . '%"';
						} else {
							$sql .= ' ENDERECO.bairro LIKE "%' . $filtros['bairro'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['cidade'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.cidade LIKE "%' . $filtros['cidade'] . '%"';
						} else {
							$sql .= ' ENDERECO.cidade LIKE "%' . $filtros['cidade'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['estado'] != ''){
						if($jaTem){
							$sql .= ' AND APIARIO.estado LIKE "%' . $filtros['estado'] . '%"';
						} else {
							$sql .= ' APIARIO.estado LIKE "%' . $filtros['estado'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['cep'] != ''){
						if($jaTem){
							$sql .= ' AND APIARIO.cep = "' . $filtros['cep'] . '"';
						} else {
							$sql .= ' APIARIO.cep = "' . $filtros['cep'] . '"';
							$jaTem = True;
						}
					}
				}

				echo $sql;

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.*, ENDERECO.* FROM APIARIO, ENDERECO, PROPRIEDADE WHERE APIARIO.propriedade = PROPRIEDADE.id AND PROPRIEDADE.endereco = ENDERECO.id");
			}

			$stmt->execute();

			$apiarios = array();
			while($apiario = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apiarios, new Apiario($apiario['nome'], $apiario['dono'], new Endereco($apiario['id'], $apiario['logradouro'], $apiario['numero'], $apiario['complemento'], $apiario['comunidade'], $apiario['bairro'], $apiario['cidade'], $apiario['estado'], $apiario['cep']), $apiario['inscricao_estadual'], $apiario['data_fundacao'], $apiario['tipo_florada'], $apiario['latitude'], $apiario['longitude'], $apiario['expandida'], $apiario['problema_sanitario'], $apiario['numero_colmeias_povoadas'], $apiario['numero_colmeias_vazias'], $apiario['tipo_instalacao']));
			}
			
			return $apiarios;
		}

		public function recuperarApiariosPorApicultor($apicultor) {
			$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, APIARIO.dono as dono, APICULTOR.nome as nomeDono, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, APIARIO.inscricao_estadual as inscricao_estadual, APIARIO.data_fundacao as data_fundacao, APIARIO.tipo_florada as tipo_florada, APIARIO.latitude as latitude, APIARIO.longitude as longitude, APIARIO.expandida as expandida, APIARIO.problema_sanitario as problema_sanitario, APIARIO.num_caixas_povoadas as num_caixas_povoadas, APIARIO.num_caixas_vazias as num_caixas_vazias, APIARIO.tipo_instalacao as tipo_instalacao FROM APIARIO, APICULTOR, PROPRIEDADE, ENDERECO GROUP BY APICULTOR.cpf HAVING APICULTOR.cpf = APIARIO.dono AND APICULTOR.cpf = " . $apicultor->getCpf());

			$stmt->execute();

			$apiarios = array();
			while($apiario = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apiarios, new Apiario($apiario['nome'], new Apicultor($apiario['dono'], $apiario['nomeDono'], null, null, null, null, null, null, null, null, null), new Endereco($apiario['id'], $apiario['logradouro'], $apiario['numero'], $apiario['complemento'], $apiario['comunidade'], $apiario['bairro'], $apiario['cidade'], $apiario['estado'], $apiario['cep']), $apiario['inscricao_estadual'], $apiario['data_fundacao'], $apiario['tipo_florada'], $apiario['latitude'], $apiario['logintude'], $apiario['expandida'], $apiario['problema_sanitario'], $apiario['num_caixas_povoadas'], $apiario['num_caixas_vazias'], $apiario['tipo_instalacao']));
			}

			return $apiarios;
		}

		public function recuperarEnderecoApicultor($apicultor){
			$stmt = DataGetter::getConn()->prepare("SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE APICULTOR.cpf =" . $apicultor->getCpf() . " AND APICULTOR.endereco = ENDERECO.id");

			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$endereco = new Endereco($resultado['id'], $resultado['logradouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep']);

			return $endereco;
		}

		public function recuperarCaixasPorApicultor($apicultor){
			$stmt = DataGetter::getConn()->prepare("SELECT CAIXA.id as id, CAIXA.apiario as apiario, CAIXA.material as material, CAIXA.melgueiras as melgueiras, CAIXA.local_extracao as local_extracao FROM CAIXA, APIARIO, APICULTOR WHERE CAIXA.apiario = APIARIO.nome AND APIARIO.dono = " . $apicultor);

			$stmt->execute();

			$caixas = array();
			while($caixa = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($caixas, new Caixa($caixa['id'], $caixa['apiario'], null, $caixa['material'], $caixa['melgueiras'], $caixa['local_extracao']));
			}

			return $caixas;
		}

		public function recuperarCaixas($filtros){

			if(count($filtros) > 0){
				$sql = "SELECT * FROM CAIXA WHERE ";

				$jaTem = False;

				if($filtros['apiario'] != ''){
					if($jaTem){
						$sql .= ' AND CAIXA.apiario LIKE "%' . $filtros['apiario'] . '%"';
					} else {
						$sql .= ' CAIXA.apiario LIKE "%' . $filtros['apiario'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['melgueiras'] != ''){
					if($jaTem){
						$sql .= ' AND CAIXA.melgueiras = ' . $filtros['melgueiras'];
					} else {
						$sql .= ' CAIXA.melgueiras = ' . $filtros['melgueiras'];
						$jaTem = True;
					}
				}

				if($filtros['material'] != ''){
					if($jaTem){
						$sql .= ' AND CAIXA.material LIKE "%' . $filtros['material'] . '%"';
					} else {
						$sql .= ' CAIXA.material LIKE "%' . $filtros['material'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['local_extracao'] != ''){
					if($jaTem){
						$sql .= ' AND CAIXA.local_extracao LIKE "%' . $filtros['local_extracao'] . '%"';
					} else {
						$sql .= ' CAIXA.local_extracao LIKE "%' . $filtros['local_extracao'] . '%"';
						$jaTem = True;
					}
				}

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT * FROM CAIXA");
			}			

			$stmt->execute();

			$caixas = array();
			while($caixa = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($caixas, new Caixa($caixa['id'], $caixa['apiario'], $caixa['colmeia'], $caixa['material'], $caixa['melgueira'], $caixa['local_extracao']));
			}

			return $caixas;
		}

		public function recuperarContatoApicultor($apicultor){
			$stmt = DataGetter::getConn()->prepare("SELECT nome, telefone, email FROM APICULTOR WHERE cpf = " . $apicultor->getCpf());

			$stmt->execute();

			$contato = $stmt->fetch(PDO::FETCH_ASSOC);

			return $contato;
		}

		public function recuperarFumegadores(){
			$stmt = DataGetter::getConn()->prepare("SELECT * FROM FUMEGADOR");

			$stmt->execute();

			$fumegadores = array();
			while($fumegador = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($fumegadores, new Fumegador($fumegador['apicultor'], $fumegador['produto_utilizado']));
			}

			return $fumegadores;
		}

		public function recuperarFumegadoresPorAtributos($filtros){
			$sql = "SELECT * FROM FUMEGADOR WHERE ";

			$jaTem = False;

			if($filtros['apicultor'] != ''){
				if($jaTem){
					$sql .= ' AND apicultor LIKE "%' . $filtros['apicultor'] . '%"';
				} else {
					$sql .= ' apicultor LIKE "%' . $filtros['apicultor'] . '%"';
					$jaTem = True;
				}
			}

			if($filtros['produto'] != ''){
				if($jaTem){
					$sql .= ' AND produto_utilizado LIKE "%' . $filtros['produto'] . '%"';
				} else {
					$sql .= ' produto_utilizado LIKE "%' . $filtros['produto'] . '%"';
					$jaTem = True;
				}
			}

			echo $sql;

			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			$fumegadores = array();
			while($fumegador = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($fumegadores, new Fumegador($fumegador['apicultor'], $fumegador['produto_utilizado']));
			}

			return $fumegadores;
		}

		public function recuperarProducaoMel($apicultor, $ano){
			$stmt = DataGetter::getConn()->prepare("SELECT producao FROM PRODUCAO_ANUAL WHERE apicultor = " . $apicultor->getCpf() . " AND ano = " . $ano);

			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultado['producao'];	
		}

		public function recuperaApicultoresProducaoAnualMel($ano) {
			$stmt = DataGetter::getConn()->prepare("SELECT cpf, nome FROM APICULTOR WHERE cpf = (SELECT apicultor FROM PRODUCAO_ANUAL WHERE ano = " . $ano . ")");

			$stmt->execute();

			$apicultores = array();
			while($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, null, null, null));
			}

			return $apicultores;
		}

		public function recuperarPropriedadesPorApicultor($apicultor){
			$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.id = (SELECT propriedade FROM CADASTRO WHERE apicultor = " . $apicultor->getCpf() . ") AND PROPRIEDADE.endereco = ENDERECO.id");

			$stmt->execute();

			$propriedades = array();
			while($propriedade = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
			}

			return $propriedades;	
		}

		public function recuperarPropriedadesPorAreaDestinada($areaDestinada){
			$sql = "SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.endereco = ENDERECO.id AND area_destinada = " . $areaDestinada;

			$stmt = DataGetter::getConn()->prepare($sql);

			$stmt->execute();

			$propriedades = array();
			while($propriedade = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
			}

			echo count($propriedades);
			
			return $propriedades;

		}

		public function recuperarPropriedadesPorEndereco($endereco){

			$jaTem = False;

			$sql = "SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.endereco = ENDERECO.id AND";

			if($endereco->getLogradouro() != ''){				
				$sql .= ' ENDERECO.logradouro LIKE "%' . $endereco->getLogradouro() . '%"';
				$jaTem = True;
			}

			if($endereco->getNumero() != 0){
				if($jaTem){
					$sql .= ' AND ENDERECO.numero =' . $endereco->getNumero();
				} else {
					$sql .= ' ENDERECO.numero =' . $endereco->getNumero();
					$jaTem = True;
				}
			}

			if($endereco->getComplemento() != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.complemento LIKE "%' . $endereco->getComplemento() . '%"';
				} else {
					$sql .= ' ENDERECO.complemento LIKE "%' . $endereco->getComplemento() . '%"';
					$jaTem = True;
				}
			}

			if($endereco->getBairro() != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.bairro LIKE "%' . $endereco->getBairro() . '%"';
				} else {
					$sql .= ' ENDERECO.bairro LIKE "%' . $endereco->getBairro() . '%"';
					$jaTem = True;
				}
			}

			if($endereco->getComunidade() != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.comunidade LIKE "%' . $endereco->getComunidade() . '%"';
				} else {
					$sql .= ' ENDERECO.comunidade LIKE "%' . $endereco->getComunidade() . '%"';
					$jaTem = True;
				}
			}

			if($endereco->getEstado() != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.estado LIKE "%' . $endereco->getEstado() . '%"';
				} else {
					$sql .= ' ENDERECO.estado LIKE "%' . $endereco->getEstado() . '%"';
					$jaTem = True;
				}
			}

			if($endereco->getCep() != ''){
				if($jaTem){
					$sql .= ' AND ENDERECO.cep LIKE "%' . $endereco->getCep() . '%"';
				} else {
					$sql .= ' ENDERECO.cep LIKE "%' . $endereco->getCep() . '%"';
					$jaTem = True;
				}
			}

			echo $sql;

			$stmt = DataGetter::getConn()->prepare($sql);

			$stmt->execute();

			$propriedades = array();
			while($propriedade = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
			}
			
			return $propriedades;	
		}

		public function recuperarDonosDePropriedade(){
			$stmt = DataGetter::getConn()->prepare('SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificao as certificacao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.producao_anual as producao_anual, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE vinculo LIKE "%Própria%"');

			$stmt->execute();

			$apicultores = array();
			while($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], $apicultor['certificacao'], $apicultor['email'], $apicultor['telefone'], $apicultor['producao_anual'], $apicultor['perfil'], $apicultor['vinculo'], new Endereco($apicultor['id'], $apicultor['logradouro'], $apicultor['numero'], $apicultor['complemento'], $apicultor['comunidade'], $apicultor['bairro'], $apicultor['cidade'], $apicultor['estado'], $apicultor['cep']), null));
			}

			$stmt = DataGetter::getConn()->prepare('SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM ENDERECO WHERE ENDERECO.id = (SELECT endereco FROM PROPRIEDADE WHERE id = (SELECT trabalha_em FROM APICULTOR WHERE vinculo LIKE "%Própria%"))');

			$stmt->execute();
			$propriedades = array();
			while($propriedade = $stmt->fetch(PDO::FETCH_ASSOC)){
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
			while($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, $apicultor['vinculo'], null, null));
			}

			return $apicultores;
		}

		public function recuperarTiposAbelhaPorApicultor($apicultor){
			$stmt = DataGetter::getConn()->prepare('SELECT especie_abelha FROM COLMEIA WHERE id = (SELECT colmeia FROM CAIXA WHERE apiario = (SELECT nome FROM APIARIO WHERE dono = ' . $apicultor->getCpf() . '))');

			$stmt->execute();

			$tipos = array();
			while($tipo = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($tipos, $tipo);
			}

			return $tipos;
		}

		public function recuperarPropriedades(){
			$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.endereco = ENDERECO.id");

			$stmt->execute();

			$propriedades = array();
			while($propriedade = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
			}

			return $propriedades;
		}

		public function recuperarCaixasPorApiario($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT CAIXA.id as id, CAIXA.apiario as apiario, CAIXA.material as material, CAIXA.melgueiras as melgueiras, CAIXA.local_extracao as local_extracao FROM CAIXA WHERE CAIXA.apiario = " . $apiario);

			$stmt->execute();

			$caixas = array();
			while($caixa = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($caixas, new Caixa($caixa['id'], $caixa['apiario'], null, $caixa['material'], $caixa['melgueiras'], $caixa['local_extracao']));
			}

			return $caixas;
		}

		public function recuperarTipoFlorada($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT tipo_florada FROM APIARIO WHERE nome =" . $apiario->getCpf());

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultado['tipo_florada'];	
		}

		public function recuperarCoordenada($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT latitude, longitude FROM APIARIO WHERE nome =" . $apiario->getCpf());

			$stmt->execute();

			$coordenada = $stmt->fetch(PDO::FETCH_ASSOC);

			return $coordenada;
		}

		public function recuperarAreaDestinada($endereço){
			$stmt = DataGetter::getConn()->prepare("SELECT area_destinada FROM PROPRIEDADE WHERE PROPRIEDADE.endereco = (SELECT id FROM ENDERECO WHERE cep = " . $endereco->getCep() . " AND numero = " . $endereco->getNumero() . ")");

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['area_destinada'];
		}

		public function recuperarPropriedadePorApiario($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT PROPRIEDADE.id as id, ENDERECO.id as idE, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE PROPRIEDADE.id = (SELECT propriedade FROM APIARIO WHERE nome = " . $apiario->getNome() . ")");

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$propriedade = new Propriedade($resultado['id'], new Endereco($resultado['id'], $resultado['logradouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep']), $resultado['area_destinada']);
			
			return $propriedade;
		}

		public function recuperarEnderecoPropriedade($propriedade){
			$stmt = DataGetter::getConn()->prepare("SELECT ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM ENDERECO WHERE ENDERECO.id = (SELECT endereco FROM PROPRIEDADE WHERE endereco = " . $propriedade->getEndereco()->getId() . ")");

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$endereco = new Endereco($resultado['id'], $resultado['lograouro'], $resultado['numero'], $resultado['complemento'], $resultado['comunidade'], $resultado['bairro'], $resultado['cidade'], $resultado['estado'], $resultado['cep']);

			return $endereco;
		}

		public function recuperarApicultoresPorPropriedade($propriedade){
			$stmt = DataGetter::getConn()->prepare("SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.trabalha_em as trabalha_em FROM APICULTOR, PROPRIEDADE GROUP BY trabalha_em HAVING trabalha_em = " . $propriedade->getId());

			$stmt->execute();

			$apicultores = array();
			while($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], null, null, null, null, null, null, null, null));
			}

			return $apicultores;
		}

		public function recuperarMesesChuvososPorPropriedade($propriedade){
			$stmt = DataGetter::getConn()->prepare("SELECT data, MAX(indice_pluviometrico) as indice_pluviometrico FROM MEDICOES_CLIMATICAS	WHERE propriedade = " . $propriedade->getId());

			$stmt->execute();

			$medicoes = array();
			while($medicao = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($medicoes, new MedicoesClimaticas($propriedade, $medicao['data'], null, null, $medicao['indice_pluviometrico']));
			}

			return $medicoes;
		}

		public function recuperarInformacoesClimaticas($ano, $propriedade){
			$stmt = DataGetter()->getConn()->prepare("SELECT temperatura, umidade_ar FROM MEDICOES_CLIMATICAS WHERE data LIKE '%/" . $ano . "' AND propriedade = " . $propriedade->getId());

			$stmt->execute();

			$medicoes = array();
			while($medicao = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($medicoes, new MedicoesClimaticas($propriedade, null, $medicao['temperatura'], $medicao['umidade_ar'], null));
			}

			return $medicoes;
		}

		public function recuperarInscricaoEstadual($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT inscricao_estadual FROM APIARIO WHERE nome = " . $apiario->getNome());

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultado['inscricao_estadual'];
		}

		public function apiarioPossuiLocalProducao($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, APIARIO.dono as dono FROM APIARIO LEFT JOIN PRODUCAO ON nome = PRODUCAO.apiario WHERE PRODUCAO.apiario IS NULL AND nome = " . $apiario->getNome());

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return count($resultado);

		}

		public function recuperarTiposAbelhaPorApiario($apiario){
			$stmt = DataGetter::getConn()->prepare('SELECT especie_abelha FROM COLMEIA WHERE id = (SELECT colmeia FROM CAIXA WHERE apiario = ' . $apiario->getNome() . ')');

			$stmt->execute();

			$tipos = array();
			while($tipo = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($tipos, $tipo);
			}

			return $tipos;
		}

		public function recuperarApiarioPossuemLocalProducao(){
			$stmt = DataGetter::getConn()->prepare("SELECT DISTINCT apiario FROM PRODUCAO");

			$apiarios = array();
			while($apiario = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apiarios, $apiario['apiario']);
			}

			return $apiarios;
		}

		public function recuperarMaterialProducao($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT DISTINCT material FROM PRODUCAO WHERE apiario = " . $apiario->getNome());

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultado['material'];
		}

		public function recuperarDestinoProducao($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT destino FROM PRODUCAO WHERE apiario = " . $apiario->getNome());

			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultado['destino'];
		}

		/*public function recuperarControlesVeterinarios($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT id, data_exame, condicao_vet_geral, nome_veterinario, crmv_veterinario FROM CONTROLE_VETERINARIO ORDER BY data_exame WHERE apiario = " . $apiario->getNome());

			$stmt->execute();

			$controles = array();
			while($controle = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($controles, new ControleVeterinario($controle['id'], $apiario->getNome(), $controle['data_exame'], $controle['condicao_vet_geral'], $controle['nome_veterinario'], $controle['crmv_veterinario']));
			}

			return $controles;
		}*/

		public function recuperarControlesVeterinarios($filtros){
			if(count($filtros) > 0){
				$sql = "SELECT * FROM CONTROLE_VETERINARIO WHERE ";

				$jaTem = False;


				if($filtros['data_exame'] != ''){
					if($jaTem){
						$sql .= ' AND CONTROLE_VETERINARIO.data_exame = "' . $filtros['data_exame'] . '"';
					} else {
						$sql .= ' CONTROLE_VETERINARIO.data_exame = "' . $filtros['data_exame'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['condicao_vet_geral'] != ''){
					if($jaTem){
						$sql .= ' AND CONTROLE_VETERINARIO.condicao_vet_geral LIKE "%' . $filtros['condicao_vet_geral'] . '%"';
					} else {
						$sql .= ' CONTROLE_VETERINARIO.condicao_vet_geral LIKE "%' . $filtros['condicao_vet_geral'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['nome_veterinario'] != ''){
					if($jaTem){
						$sql .= ' AND CONTROLE_VETERINARIO.nome_veterinario LIKE "%' . $filtros['nome_veterinario'] . '%"';
					} else {
						$sql .= ' CONTROLE_VETERINARIO.nome_veterinario LIKE "%' . $filtros['nome_veterinario'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['crmv_veterinario'] != ''){
					if($jaTem){
						$sql .= ' AND CONTROLE_VETERINARIO.crmv_veterinario LIKE "%' . $filtros['crmv_veterinario'] . '%"';
					} else {
						$sql .= ' CONTROLE_VETERINARIO.crmv_veterinario LIKE "%' . $filtros['crmv_veterinario'] . '%"';
						$jaTem = True;
					}
				}

				$sql .= ' ORDER BY data_exame';

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT * FROM CONTROLE_VETERINARIO ORDER BY data_exame");
			}

			$stmt->execute();

			$controles = array();
			while($controle = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($controles, new ControleVeterinario($controle['id'], $controle['apiario'], $controle['data_exame'], $controle['condicao_vet_geral'], $controle['nome_veterinario'], $controle['crmv_veterinario']));
			}

			return $controles;
		}

		public function recuperarInformacoesVeterinarioControle($apiario, $data){
			$stmt = DataGetter::getConn()->prepare("SELECT nome_veterinario, crmv_veterinario FROM CONTROLE_VETERINARIO WHERE data_exame = " . $data . " AND apiario = " . $apiario->getNome());

			$stmt->execute();
			$info = $stmt->fetch(PDO::FETCH_ASSOC);

			return $info;
		}

		public function recuperarInformacoesVeterinarioTratamento($data){
			$stmt = DataGetter::getConn()->prepare("SELECT nome_veterinario, crmv_veterinario FROM TRATAMENTO WHERE data_tratamento = " . $data);

			$stmt->execute();
			$info = $stmt->fetch(PDO::FETCH_ASSOC);

			return $info;
		}

		public function recuperarTratamentosColmeias($apiario) {
			$stmt = DataGetter::getConn()->prepare("SELECT TRATAMENTO.* FROM TRATAMENTO, CAIXA WHERE CAIXA.apiario = " . $apiario->getNome() . "AND CAIXA.colmeia = TRATAMENTO.colmeia");

			$stmt->execute();

			$tratamentos = array();
			while($tratamento = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($tratamentos, new Tratamento($tratamento['id'], $tratamento['quantidade_doses'], $tratamento['forma_dosagem'], $tratamento['doenca'], $tratamento['produto'], $tratamento['data_tratamento'], $tratamento['nome_veterinario'], $tratamento['crmv_veterinario']));
			}

			return $tratamentos;
		}

		public function colmeiasApresentaramProblema($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT * FROM APIARIO WHERE EXISTS (SELECT TRATAMENTO.* FROM TRATAMENTO, CAIXA WHERE CAIXA.apiario = APIARIO.nome AND APIARIO.nome = " . $apiario->getNome() . " AND CAIXA.colmeia = TRATAMENTO.colmeia AND TRATAMENTO.doenca IS NOT NULL)");

			$stmt->execute();
			$apiario = $stmt->fetch(PDO::FETCH_ASSOC);

			return count($apiario);
		}

		public function recuperarCondicaoVeterinaria($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT data_exame, condicao_vet_geral FROM CONTROLE_VETERINARIO WHERE apiario = " . $apiario->getNome());

			$condicoes = array();
			while($condicao = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($condicoes, $condicao);
			}

			return $condicoes;
		}

		public function alterarPropriedade($propriedade){
			$sql = "UPDATE PROPRIEDADE SET endereco = " . $propriedade->getEndereco()->getId() . " SET area_destinada = " . $propriedade->getAreaDestinada() . " WHERE id = " . $propriedade->getId();
			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				return true;
			} else {
				return false;
			}
		}

		public function alterarControleVeterinario($controleVeterinario){
			$sql = "UPDATE CONTROLE_VETERINARIO SET apiario = " . $controleVeterinaio->getApiario() . " SET data_exame = " . $controleVeterinario->getDataExame() . " SET condicao_vet_geral = " . $controleVeterinario->getCondicaoVetGeral() . " SET nome_veterinario = " . $controleVeterinario->getNomeVeterinario() . " SET crmv_veterinario = " . $controleVeterinario->getCrmvVeterinario() . " WHERE id = " . $controleVeterinario->getId();
			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				return 1;
			} else {
				return 0;
			}
		}

		public function alterarProducao($producao){
			$sql = "UPDATE PRODUCAO SET rotulo = " . $producao->getRotulo() . " SET destino = " . $producao->getDestino() . " SET tipo = " . $producao->getTipo() . " SET material = " . $producao->getMaterial() . " WHERE apiario = " . $producao->getApiario();
			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				return 1;
			} else {
				return 0;
			}
		}

		public function recuperarApicultorPorAtributo($nomeAtributo, $valor){
			$sql = "SELECT cpf, nome FROM APICULTOR WHERE " . $nomeAtributo . " = " . $valor;
			$stmt = DataGetter::getConn()->prepare($sql);
			$stmt->execute();

			$apicultor = $stmt->fetch(PDO::FETCH_ASSOC);

			return $apicultor;
		}

		public function recuperarApicultores($filtros){
			if(count($filtros) > 0){
				$sql = "SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificacao as certificacao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.bairro as bairro, ENDERECO.comunidade as comunidade, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE ENDERECO.id = APICULTOR.endereco AND";

				$jaTem = False;

				if($filtros['nome'] != ''){
					$sql .= ' APICULTOR.nome LIKE "%' . $filtros['nome'] . '%"';
					$jaTem = True;
				}

				if($filtros['cpf'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.cpf = "' . $filtros['cpf'] . '"';
					} else {
						$sql .= ' APICULTOR.cpf = "' . $filtros['cpf'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['certificacao'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.certificacao = "' . $filtros['certificacao'] . '"';
					} else {
						$sql .= ' APICULTOR.certificacao = "' . $filtros['certificacao'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['email'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.email LIKE "%' . $filtros['email'] . '%"';
					} else {
						$sql .= ' APICULTOR.email = "' . $filtros['email'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['telefone'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.telefone = "' . $filtros['telefone'] . '"';
					} else {
						$sql .= ' APICULTOR.telefone = "' . $filtros['telefone'] . '"';
						$jaTem = True;
					}
				}

				/*if($filtros['producao_anual'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.producao_anual = ' . $filtros['producao_anual'];
					} else {
						$sql .= ' APICULTOR.producao_anual = ' . $filtros['producao_anual'];
						$jaTem = True;
					}
				}*/

				if($filtros['perfil'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.perfil = "' . $filtros['perfil'] . '"';
					} else {
						$sql .= ' APICULTOR.perfil = "' . $filtros['perfil'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['vinculo'] != ''){
					if($jaTem){
						$sql .= ' AND APICULTOR.vinculo = "' . $filtros['vinculo'] . '"';
					} else {
						$sql .= ' APICULTOR.vinculo = "' . $filtros['vinculo'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['logradouro'] != '' || $filtros['numero'] != '' || $filtros['complemento'] != '' || $filtros['bairro'] != '' || $filtros['comunidade'] != '' || $filtros['cidade'] != '' || $filtros['estado'] != '' || $filtros['cep'] != ''){

					if($filtros['logradouro'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.logradouro LIKE "%' . $filtros['logradouro'] . '%"';
						} else {
							$sql .= ' ENDERECO.logradouro LIKE "%' . $filtros['logradouro'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['numero'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.numero = ' . $filtros['numero'];
						} else {
							$sql .= ' ENDERECO.numero = ' . $filtros['numero'];
							$jaTem = True;
						}
					}

					if($filtros['complemento'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.complemento LIKE "%' . $filtros['complemento'] . '%"';
						} else {
							$sql .= ' ENDERECO.complemento LIKE "%' . $filtros['complemento'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['comunidade'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.comunidade LIKE "%' . $filtros['comunidade'] . '%"';
						} else {
							$sql .= ' ENDERECO.comunidade LIKE "%' . $filtros['comunidade'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['bairro'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.bairro LIKE "%' . $filtros['bairro'] . '%"';
						} else {
							$sql .= ' ENDERECO.bairro LIKE "%' . $filtros['bairro'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['cidade'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.cidade LIKE "%' . $filtros['cidade'] . '%"';
						} else {
							$sql .= ' ENDERECO.cidade LIKE "%' . $filtros['cidade'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['estado'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.estado LIKE "%' . $filtros['estado'] . '%"';
						} else {
							$sql .= ' ENDERECO.estado LIKE "%' . $filtros['estado'] . '%"';
							$jaTem = True;
						}
					}

					if($filtros['cep'] != ''){
						if($jaTem){
							$sql .= ' AND ENDERECO.cep = "' . $filtros['cep'] . '"';
						} else {
							$sql .= ' ENDERECO.cep = "' . $filtros['cep'] . '"';
							$jaTem = True;
						}
					}
				}

			} else {
				$sql = "SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificacao as certificacao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.bairro as bairro, ENDERECO.comunidade as comunidade, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE ENDERECO.id = APICULTOR.endereco";

			}
			echo $sql;
			$stmt = DataGetter::getConn()->prepare($sql);

			$stmt->execute();

			$apicultores = array();
			while($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], $apicultor['certificacao'], $apicultor['email'], $apicultor['telefone'], $apicultor['perfil'], $apicultor['vinculo'], new Endereco($apicultor['id'], $apicultor['logradouro'], $apicultor['numero'], $apicultor['complemento'], $apicultor['bairro'], $apicultor['comunidade'], $apicultor['cidade'], $apicultor['estado'], $apicultor['cep']), null));
			}
			echo count($apicultores);
			return $apicultores;
		}

		public function removerFumegador($fumegador){
			try {
				$sql = "DELETE FROM FUMEGADOR WHERE apicultor = '" . $fumegador->getApicultor() . "' AND produto_utilizado = '" . $fumegador->getProdutoUtilizado() . "'";

				echo $sql;

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function removerProducao($producao){
			try {
				$sql = "DELETE FROM PRODUCAO WHERE apiario = " . $producao->getApiario()->getNome() . " AND rotulo = " . $producao->getRotulo() . " AND destino=" . $producao->getDestino() . "AND tipo=" . $producao->getTipo() . " AND material=" . $producao->getMaterial();

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function removerControle($controle){
			try {
				$sql = "DELETE FROM CONTROLE_VETERINARIO WHERE id = " . $controle->getId();

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function removerPropriedade($propriedade){
			try {
				$sql = "DELETE FROM PROPRIEDADE WHERE id = " . $propriedade->getId();

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function removerCaixa($caixa){
			try {
				$sql = "DELETE FROM CAIXA WHERE id = " . $caixa->getId();

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function removerTratamento($tratamento){
			try {
				$sql = "DELETE FROM TRATAMENTO WHERE colmeia = " . $tratamento->getColmeia() . " AND quantidade_doses = " . $tratamento->getQuantidadeDoses() . " AND forma_dosagem = '" . $tratamento->getFormaDosagem() . "' AND doenca = '" . $tratamento->getDoenca() . "' AND produto = '" . $tratamento->getProduto() . "' AND data_tratamento = '". $tratamento->getDataTratamento() . "' AND nome_veterinario = '" . $tratamento->getNomeVeterinario() . "' AND crmv_veterinario = '" . $tratamento->getCrmvVeterinario() . "'";

				echo $sql;

				$stmt = DataGetter::getConn()->prepare($sql);
				$stmt->execute();

				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}

		public function recuperarTratamentos($filtros){
			if(count($filtros) > 0){
				$sql = "SELECT * FROM TRATAMENTO WHERE ";

				$jaTem = False;

				if($filtros['data_tratamento'] != ''){
					if($jaTem){
						$sql .= ' AND TRATAMENTO.data_tratamento = "' . $filtros['data_tratamento'] . '"';
					} else {
						$sql .= ' TRATAMENTO.data_tratamento = "' . $filtros['data_tratamento'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['nome_veterinario'] != ''){
					if($jaTem){
						$sql .= ' AND TRATAMENTO.nome_veterinario LIKE "%' . $filtros['nome_veterinario'] . '%"';
					} else {
						$sql .= ' TRATAMENTO.nome_veterinario LIKE "%' . $filtros['nome_veterinario'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['crmv_veterinario'] != ''){
					if($jaTem){
						$sql .= ' AND TRATAMENTO.crmv_veterinario = "' . $filtros['crmv_veterinario'] . '"';
					} else {
						$sql .= ' TRATAMENTO.crmv_veterinario = "' . $filtros['crmv_veterinario'] . '"';
						$jaTem = True;
					}
				}

				if($filtros['doenca'] != ''){
					if($jaTem){
						$sql .= ' AND TRATAMENTO.doenca LIKE "%' . $filtros['doenca'] . '%"';
					} else {
						$sql .= ' TRATAMENTO.doenca LIKE "%' . $filtros['doenca'] . '%"';
						$jaTem = True;
					}
				}

				if($filtros['produto'] != ''){
					if($jaTem){
						$sql .= ' AND TRATAMENTO.produto LIKE "%' . $filtros['produto'] . '%"';
					} else {
						$sql .= ' TRATAMENTO.produto LIKE "%' . $filtros['produto'] . '%"';
						$jaTem = True;
					}
				}

				$sql .= ' ORDER BY data_tratamento';

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT * FROM TRATAMENTO ORDER BY data_tratamento");
			}

			$stmt->execute();

			$tratamentos = array();
			while($tratamento = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($tratamentos, new Tratamento($tratamento['colmeia'], $tratamento['quantidade_doses'], $tratamento['forma_dosagem'], $tratamento['doenca'], $tratamento['produto'], $tratamento['data_tratamento'], $tratamento['nome_veterinario'], $tratamento['crmv_veterinario']));
			}

			return $tratamentos;
		}

		public function cadastrarMedicao($data, $temperatura, $umidade, $precipitacao, $propriedade){
			$sql = 'INSERT INTO MEDICOES_CLIMATICAS VALUES ('. $propriedade . ', "' . $data . '", ' . $temperatura . ', ' . $umidade . ', ' . $precipitacao . ')'; 

			echo $sql;

			$stmt = DataGetter::getConn()->prepare($sql);
			
			if($stmt->execute()){
				return True;
			} else {
				return False;
			}
		}
	}

?>