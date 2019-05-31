<?php
	/**
	*Classe de instancia unica que faz conexao com a base de dados
	*/
	class DataGetter {
		private static $servername = "localhost";
		private static $username = "root";
		private static $password = "";
		private static $conn;

		/**
		*Evitam que DataGetter seja instanciado fora da classe
		*/
		private function __constructor(){}
		private function __clone(){}
		private function __wakeup(){}
		/**
		*Garante que a classe DataGetter so vai ter uma instancia. Se a classe nao tiver sido instanciada, cria uma nova instancia, se ja tiver sido instanciada, retorna essa instancia.
		*/
		public static function getConn(){
			if (self::$conn===null){
				try {
					self::$conn = new PDO("mysql:host=localhost;dbname=gaa_db", self::$username, self::$password);
					self::$conn->exec("set names utf8");
					self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					echo "Conectado com sucesso";
				}
				catch(PDOException $e){
					echo "Conexão falhou: " . $e->getMessage();
				}
			}
			return self::$conn;
		}

		/**
		*Retorna o conteudo do arquivo cujo nome eh passado como parametro em forma de matriz
		*/
		public function getData($nomearquivo){
			
		}
		/**
		*Substitui os dados do arquivo cujo nome eh recebido como parametro com o conteudo em data
		*/
		public function insertData(){

		}
		/**
		*Incrementa o conteudo do arquivo cujo nome eh recebido como parametro com o conteudo em data
		*/
		public function appendData($nomearquivo, $data){
			
		}
	}
?>