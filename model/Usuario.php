<?php
	/*
	editar apiario
	editar caixa
	editar medição climatica
	excluir medição climatica
	cadastrar producao anual
	buscar produção anual
	editar produção anual
	excluir produção anual
	 */

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
			$sql = "SELECT nome, cpf, email, senha FROM USUARIO WHERE cpf = " . $cpf;
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

		public function cadastrarEndereco($logradouro, $numero, $complemento, $bairro, $comunidade, $cidade, $estado, $cep){

			$sql = 'INSERT INTO APIARIO (logradouro, numero, complemento, bairro, comunidade, cidade, estado, cep) VALUES ("'. $logradouro . '", "' . $numero . '", ' . $complemento . ', "' . $bairro . '", "' . $comunidade . '", "' . $cidade . '", ' . $estado . ', ' . $cep . '")'; 


			$stmt = DataGetter::getConn()->prepare($sql);
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

			if($stmt->execute()){
				return True;
			} else {
				return False;
			}
		}

		public function cadastrarCaixa($apiario, $colmeia, $material, $melgueira /* int */ , $local_extracao){
			$sql = 'INSERT INTO CAIXA (apiario, colmeia, material, melgueira , local_extracao) VALUES (' . $apiario . ', ' . $colmeia . ', ' . $material . ', ' . $melgueira . ', ' . $local_extracao . ')';
			DataGetter::getConn()->exec($sql);
		}

		public function cadastrarColmeia($especie_abelha /* varchar(45) */, $origem /* varchar(45) */, $data_troca_rainha /* DATE/STRING */){
			$sql = 'INSERT INTO COLMEIA (especie_abelha, origem, data_troca_rainha) VALUES (' . $especie_abelha . ', ' . $origem . ', ' . $data_troca_rainha . ')';
			DataGetter::getConn()->exec($sql);
		}

		public function cadastrarControleVeterinario($apiario, $data_exame, $condicao_vet_geral, $nome_veterinario, $crmv_veterinario){
			$sql = 'INSERT INTO CONTROLE_VETERINARIO (apiario, data_exame, condicao_vet_geral, nome_veterinario, crmv_veterinario) VALUES (' . $apiario . ',' . $data_exame . ',' . $condicao_vet_geral . ',' . $nome_veterinario . ',' . $crmv_veterinario . ')';
			DataGetter::getConn()->exec($sql);

		}

		public function cadastrarAmostra($controle_veterinario, $tipo_abelha, $material_biologico, $mel){
			$sql = 'INSERT INTO CONTROLE_VETERINARIO (controle_veterinario, tipo_abelha, material_biologico, mel) VALUES (' . $controle_veterinario . ',' . $tipo_abelha . ',' . $material_biologico . ',' . $mel . ')';
			DataGetter::getConn()->exec($sql);

		}

		public function cadastrarProducao($apiario, $rotulo, $destino, $tipo, $material){
			$sql = 'INSERT INTO PRODUCAO VALUES (' . $apiario . ',' . $rotulo . ',' . $destino . ',' . $tipo . ',' . $material . ')';
			DataGetter::getConn->exec($sql);

		}

		public function cadastrarPropriedade($endereco, $area_destinada){
			$sql = 'INSERT INTO PROPRIEDADE VALUES (' . $endereco . ',' . $area_destinada . ')';
			DataGetter::getConn()->exec($sql);
		}

		public function recuperarApiarios($filtros){
			if(count($filtros) > 0){

				$sql = "SELECT APIARIO.nome as nome, APIARIO.dono as dono, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, APIARIO.inscricao_estadual as inscricao_estadual, APIARIO.data_fundacao as data_fundacao, APIARIO.tipo_florada as tipo_florada, APIARIO.latitude as latitude, APIARIO.longitude as longitude, APIARIO.expandida as expandida, APIARIO.problema_sanitario as problema_sanitario, APIARIO.numero_colmeias_povoadas as num_caixas_povoadas, APIARIO.numero_colmeias_vazias as num_caixas_vazias, APIARIO.tipo_instalacao as tipo_instalacao FROM APIARIO, APICULTOR, PROPRIEDADE, ENDERECO WHERE ";

				$jaTem = False;

				if($filtros['nome'] != ''){
					$sql .= 'APIARIO.nome = ' . $filtros['nome'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['dono'] != ''){
					$sql .= 'APIARIO.dono = ' . $filtros['dono'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['inscricao_estadual'] != ''){
					$sql .= 'APIARIO.inscricao_estadual = ' . $filtros['inscricao_estadual'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['data_fundacao'] != ''){
					$sql .= 'APIARIO.data_fundacao = ' . $filtros['data_fundacao'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['latitude'] != ''){
					$sql .= 'APIARIO.latitude = ' . $filtros['latitude'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['longitude'] != ''){
					$sql .= 'APIARIO.longitude = ' . $filtros['longitude'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['tipo_instalacao'] != ''){
					$sql .= 'APIARIO.tipo_instalacao = ' . $filtros['tipo_instalacao'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['logradouro'] != '' || $filtros['numero'] != '' || $filtros['complemento'] != '' || $filtros['bairro'] != '' || $filtros['comunidade'] != '' || $filtros['cidade'] != '' || $filtros['estado'] != '' || $filtros['cep'] != ''){

					$sql .= 'ENDERECO.id = APIARIO.endereco AND ';

					if($filtros['logradouro'] != ''){
						$sql .= 'ENDERECO.logradouro = ' . $filtros['logradouro'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['numero'] != ''){
						$sql .= 'ENDERECO.numero = ' . $filtros['numero'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['complemento'] != ''){
						$sql .= 'ENDERECO.complemento = ' . $filtros['complemento'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['comunidade'] != ''){
						$sql .= 'ENDERECO.comunidade = ' . $filtros['comunidade'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['bairro'] != ''){
						$sql .= 'ENDERECO.bairro = ' . $filtros['bairro'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['cidade'] != ''){
						$sql .= 'ENDERECO.cidade = ' . $filtros['cidade'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['estado'] != ''){
						$sql .= 'ENDERECO.estado = ' . $filtros['estado'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}

					if($filtros['cep'] != ''){
						$sql .= 'ENDERECO.cep = ' . $filtros['cep'];

						if($jaTem){
							$sql .= ' AND ';
						} else {
							$jaTem = True;
						}
					}
				}

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT APIARIO.nome as nome, APIARIO.dono as dono, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, APIARIO.inscricao_estadual as inscricao_estadual, APIARIO.data_fundacao as data_fundacao, APIARIO.tipo_florada as tipo_florada, APIARIO.latitude as latitude, APIARIO.longitude as longitude, APIARIO.expandida as expandida, APIARIO.problema_sanitario as problema_sanitario, APIARIO.numero_colmeias_povoadas as num_caixas_povoadas, APIARIO.numero_colmeias_vazias as num_caixas_vazias, APIARIO.tipo_instalacao as tipo_instalacao FROM APIARIO, APICULTOR, PROPRIEDADE, ENDERECO WHERE APIARIO.propriedade = PROPRIEDADE.id AND PROPRIEDADE.endereco = ENDERECO.id");
			}

			$stmt->execute();

			$apiarios = array();
			while($apiario = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apiarios, new Apiario($apiario['nome'], $apiario['dono'], new Endereco($apiario['id'], $apiario['logradouro'], $apiario['numero'], $apiario['complemento'], $apiario['comunidade'], $apiario['bairro'], $apiario['cidade'], $apiario['estado'], $apiario['cep']), $apiario['inscricao_estadual'], $apiario['data_fundacao'], $apiario['tipo_florada'], $apiario['latitude'], $apiario['longitude'], $apiario['expandida'], $apiario['problema_sanitario'], $apiario['num_caixas_povoadas'], $apiario['num_caixas_vazias'], $apiario['tipo_instalacao']));
			}

			return $apiarios;
		}

		public function recuperarIdColmeia($especie_abelha /* varchar(45) */, $origem /* varchar(45) */, $data_troca_rainha /* DATE/STRING */){
			$stmt = DataGetter::getConn()->prepare("SELECT id FROM COLMEIA WHERE especie_abelha = " . $especie_abelha . " AND origem = " . $origem . " AND data_troca_rainha = " . $data_troca_rainha);
			$stmt->execute();

			$id = $stmt->fetch(PDO::FETCH_ASSOC);

			return $id['id'];
		}

		public function recuperarIdControleVeterinario($apiario, $data_exame, $condicao_vet_geral, $nome_veterinario, $crmv_veterinario){
			$stmt = DataGetter::getConn()->prepare("SELECT id FROM CONTROLE_VETERINARIO WHERE apiario = " . $apiario . " AND data_exame = " . $data_exame . " AND condicao_vet_geral = " . $condicao_vet_geral . " AND nome_veterinario = " . $nome_veterinario . " AND crmv_veterinario = " . $crmv_veterinario);
			$stmt->execute();

			$id = $stmt->fetch(PDO::FETCH_ASSOC);

			return $id['id'];
		}

		public function recuperarIdEndereco($logradouro, $numero, $complemento, $bairro, $comunidade, $cidade, $estado, $cep){
			$stmt = DataGetter::getConn()->prepare("SELECT id FROM CONTROLE_VETERINARIO WHERE logradouro = " . $logradouro . " AND numero = " . $numero . " AND complemento = " . $complemento . " AND bairro = " . $bairro . " AND comunidade = " . $comunidade . " AND cidade = " . $cidade . " AND estado = " . $estado . " AND cep = " . $cep);
			$stmt->execute();

			$id = $stmt->fetch(PDO::FETCH_ASSOC);

			return $id['id'];
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

		public function recuperarCaixaPorId($id){
			$stmt = DataGetter::getConn()->prepare("SELECT * FROM CAIXA WHERE CAIXA.id = " . $id . ")");

			$stmt->execute();

			$caixa = $stmt->fetch(PDO::FETCH_ASSOC)
			$caixaClasse = new Caixa($caixa['id'], $caixa['apiario'], $caixa['colmeia'], $caixa['material'], $caixa['melgueira'], $caixa['local_extracao']);

			return $caixaClasse;
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
				$sql .= 'apicultor = "' . $filtros['apicultor'] . '"';

				if($jaTem){
					$sql .= ' AND ';
				} else {
					$jaTem = True;
				}
			}

			if($filtros['produto'] != ''){
				$sql .= 'produto_utilizado = "' . $filtros['produto'] . '"';

				if($jaTem){
					$sql .= ' AND ';
				} else {
					$jaTem = True;
				}
			}

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
			$sql = "SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE area_destinada = " . $areaDestinada;

			$stmt = DataGetter::getConn()->prepare($sql);

			$stmt->execute();

			$propriedades = array();
			while($stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($propriedades, new Propriedade($propriedade['id'], new Endereco($propriedade['idEnd'], $propriedade['logradouro'], $propriedade['numero'], $propriedade['complemento'], $propriedade['comunidade'], $propriedade['bairro'], $propriedade['cidade'], $propriedade['estado'], $propriedade['cep']), $propriedade['area_destinada']));
			}
			
			return $propriedades;

		}

		public function recuperarPropriedadesPorEndereco($endereco){

			$temUm = False;

			$sql = "SELECT PROPRIEDADE.id as id, ENDERECO.id as idEnd, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.comunidade as comunidade, ENDERECO.bairro as bairro, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep, PROPRIEDADE.area_destinada as area_destinada FROM PROPRIEDADE, ENDERECO WHERE ";

			if($endereco->getLogradouro() != ''){
				$sql .= "ENDERECO.logradouro = " . $endereco->getLogradouro();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getNumero() != ''){
				$sql .= "ENDERECO.numero = " . $endereco->getNumero();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getComplemento() != ''){
				$sql .= "ENDERECO.complemento = " . $endereco->getComplemento();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getComunidade() != ''){
				$sql .= "ENDERECO.comunidade = " . $endereco->getComunidade();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getBairro() != ''){
				$sql .= "ENDERECO.bairro = " . $endereco->getBairro();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getCidade() != ''){
				$sql .= "ENDERECO.cidade = " . $endereco->getCidade();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getEstado() != ''){
				$sql .= "ENDERECO.estado = " . $endereco->getEstado();

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}

			if($endereco->getCep() != ''){
				$sql .= 'ENDERECO.cep = "' . $endereco->getCep() . '"';

				if($temUm){
					$sql .= " AND ";
				} else {
					$temUm = True;
				}
			}			

			$stmt = DataGetter::getConn()->prepare($sql);

			$stmt->execute();

			$propriedades = array();
			while($stmt->fetch(PDO::FETCH_ASSOC)){
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

		public function recuperarControlesVeterinarios($apiario){
			$stmt = DataGetter::getConn()->prepare("SELECT id, data_exame, condicao_vet_geral, nome_veterinario, crmv_veterinario FROM CONTROLE_VETERINARIO ORDER BY data_exame WHERE apiario = " . $apiario->getNome());

			$stmt->execute();

			$controles = array();
			while($controle = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($controles, new ControleVeterinario($controle['id'], $apiario->getNome(), $controle['data_exame'], $controle['condicao_vet_geral'], $controle['nome_veterinario'], $controle['crmv_veterinario']));
			}

			return $controles;
		}

		public function recuperarControlesVeterinarios($filtros){
			if(count($filtros) > 0){
				$sql = "SELECT * FROM CONTROLE_VETERINARIO ORDER BY data_exame WHERE ";

				$jaTem = False;

				if($filtros['data_exame'] != ''){
					$sql .= 'CONTROLE_VETERINARIO.data_exame = ' . $filtros['data_exame'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['condicao_vet_geral'] != ''){
					$sql .= 'CONTROLE_VETERINARIO.condicao_vet_geral = ' . $filtros['condicao_vet_geral'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['nome_veterinario'] != ''){
					$sql .= 'CONTROLE_VETERINARIO.nome_veterinario = ' . $filtros['nome_veterinario'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				if($filtros['crmv_veterinario'] != ''){
					$sql .= 'CONTROLE_VETERINARIO.crmv_veterinario = ' . $filtros['crmv_veterinario'];

					if($jaTem){
						$sql .= ' AND ';
					} else {
						$jaTem = True;
					}
				}

				$stmt = DataGetter::getConn()->prepare($sql);

			} else {
				$stmt = DataGetter::getConn()->prepare("SELECT * FROM CONTROLE_VETERINARIO ORDER BY data_exame");
			}

			$stmt->execute();

			$controles = array();
			while($controle = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($controles, new ControleVeterinario($controle['id'], $apiario->getNome(), $controle['data_exame'], $controle['condicao_vet_geral'], $controle['nome_veterinario'], $controle['crmv_veterinario']));
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
				return 1;
			} else {
				return 0;
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

		public function recuperarApicultoresPorAtributos($filtros){
			$sql = "SELECT APICULTOR.cpf as cpf, APICULTOR.nome as nome, APICULTOR.certificacao as certificacao, APICULTOR.email as email, APICULTOR.telefone as telefone, APICULTOR.producao_anual as producao_anual, APICULTOR.perfil as perfil, APICULTOR.vinculo as vinculo, ENDERECO.id as id, ENDERECO.logradouro as logradouro, ENDERECO.numero as numero, ENDERECO.complemento as complemento, ENDERECO.bairro as bairro, ENDERECO.comunidade as comunidade, ENDERECO.cidade as cidade, ENDERECO.estado as estado, ENDERECO.cep as cep FROM APICULTOR, ENDERECO WHERE ";

			$jaTem = False;

			if($filtros['nome'] != ''){
				$sql .= 'APICULTOR.nome = ' . $filtros['nome'];
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
					$sql .= ' AND APICULTOR.certificacao = ' . $filtros['certificacao'];
				} else {
					$sql .= ' APICULTOR.certificacao = ' . $filtros['certificacao'];
					$jaTem = True;
				}
			}

			if($filtros['email'] != ''){
				if($jaTem){
					$sql .= ' AND APICULTOR.email = ' . $filtros['email'];
				} else {
					$sql .= ' APICULTOR.email = ' . $filtros['email'];
					$jaTem = True;
				}
			}

			if($filtros['telefone'] != ''){
				if($jaTem){
					$sql .= ' AND APICULTOR.telefone = ' . $filtros['telefone'];
				} else {
					$sql .= ' APICULTOR.telefone = ' . $filtros['telefone'];
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
					$sql .= ' AND APICULTOR.perfil = ' . $filtros['perfil'];
				} else {
					$sql .= ' APICULTOR.perfil = ' . $filtros['perfil'];
					$jaTem = True;
				}
			}

			if($filtros['vinculo'] != ''){
				if($jaTem){
					$sql .= ' AND APICULTOR.vinculo = ' . $filtros['vinculo'];
				} else {
					$sql .= ' APICULTOR.vinculo = ' . $filtros['vinculo'];
					$jaTem = True;
				}
			}

			if($filtros['logradouro'] != '' || $filtros['numero'] != '' || $filtros['complemento'] != '' || $filtros['bairro'] != '' || $filtros['comunidade'] != '' || $filtros['cidade'] != '' || $filtros['estado'] != '' || $filtros['cep'] != ''){

				$sql .= 'ENDERECO.id = APICULTOR.endereco AND ';

				if($filtros['logradouro'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.logradouro = ' . $filtros['logradouro'];
					} else {
						$sql .= ' ENDERECO.logradouro = ' . $filtros['logradouro'];
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
						$sql .= ' AND ENDERECO.complemento = ' . $filtros['complemento'];
					} else {
						$sql .= ' ENDERECO.complemento = ' . $filtros['complemento'];
						$jaTem = True;
					}
				}

				if($filtros['comunidade'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.comunidade = ' . $filtros['comunidade'];
					} else {
						$sql .= ' ENDERECO.comunidade = ' . $filtros['comunidade'];
						$jaTem = True;
					}
				}

				if($filtros['bairro'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.bairro = ' . $filtros['bairro'];
					} else {
						$sql .= ' ENDERECO.bairro = ' . $filtros['bairro'];
						$jaTem = True;
					}
				}

				if($filtros['cidade'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.cidade = ' . $filtros['cidade'];
					} else {
						$sql .= ' ENDERECO.cidade = ' . $filtros['cidade'];
						$jaTem = True;
					}
				}

				if($filtros['estado'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.estado = ' . $filtros['estado'];
					} else {
						$sql .= ' ENDERECO.estado = ' . $filtros['estado'];
						$jaTem = True;
					}
				}

				if($filtros['cep'] != ''){
					if($jaTem){
						$sql .= ' AND ENDERECO.cep = ' . $filtros['cep'];
					} else {
						$sql .= ' ENDERECO.cep = ' . $filtros['cep'];
						$jaTem = True;
					}
				}
			}

			$stmt = DataGetter::getConn()->prepare($sql);

			echo $sql;

			$stmt->execute();

			$apicultores = array();
			if($apicultor = $stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($apicultores, new Apicultor($apicultor['cpf'], $apicultor['nome'], $apicultor['certificacao'], $apicultor['email'], $apicultor['telefone'], $apicultor['producao_anual'], $apicultor['perfil'], $apicultor['vinculo'], new Endereco($apicultor['id'], $apicultor['logradouro'], $apicultor['numero'], $apicultor['complemento'], $apicultor['bairro'], $apicultor['comunidade'], $apicultor['cidade'], $apicultor['estado'], $apicultor['cep']), null));
			}

			return $apicultores;
		}

	}

?>