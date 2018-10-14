<?php

	class DbAdmin{

		private $conn;
		private $tipo;

		public function DbAdmin($tipo){

			$this->tipo = $tipo;

		}

		public function connect($host, $user, $pass, $base){

			switch ($this->tipo) {
				case 'mysql':
					//conexão ativa, guardada em "tipo"
					$this->conn = mysql_connect($host, $user, $pass) or die(mysql_error());
					mysql_select_db($base, $this->conn) or die(mysql_error());

					break;
			}
		}

		public function query($sql){

			switch ($this->tipo) {
				case 'mysql':
					$res = mysql_query($sql, $this->conn) or die(mysql_error());

					break;
			}

			return $res;
		}

		//retorna o numero de linhas da consulta sql
		public function linhas_consulta($res){

			$num = mysql_num_rows($res);
			return $num;
		}



		public function lista_query($res){

			while($linha = mysql_fetch_assoc($res)){
				$vet[] = $linha;
			}
			return $vet;
		}


		public function result ($res, $lin, $col){
			switch($this->tipo){
				
				case 'mysql':
					
					$val = mysql_result($res, $lin, $col);
				
				break;
				
				case 'pgsql':
				
					$val - pg_fetch_result($res, $lin, $col);
				
				break;
				
			}// fim switch($this->tipo){
			
			return $val;
		}// fim public function result ($res, $lin, $col)


	}



?>