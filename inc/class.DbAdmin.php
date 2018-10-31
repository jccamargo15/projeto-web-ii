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

                case 'mysqli':
                    //conexão ativa, guardada em "tipo"
                    $this->conn = mysqli_connect($host, $user, $pass, $base) or die(mysqli_error());
                    mysqli_select_db($base, $this->conn) or die(mysqli_error());

                    break;
			}
		}

		public function query($sql){

			switch ($this->tipo) {
				case 'mysql':
					$res = mysql_query($sql, $this->conn) or die(mysql_error());
					break;

                case 'mysqli':
                    $res = mysqli_query($sql, $this->conn) or die();
                    break;
			}

			return $res;
		}

		//retorna o numero de linhas da consulta sql
		public function linhas_consulta($res){
            switch ($this->tipo) {
                case 'mysql':
			        $num = mysql_num_rows($res);
			        break;

                case 'mysqli':
                    $num = mysqli_num_rows($res);
                    break;
            }

			return $num;
		}



		public function lista_query($res){
            switch ($this->tipo) {
                case 'mysql':
                    while($linha = mysql_fetch_assoc($res)){
                        $vet[] = $linha;
                    }
                    break;

                case 'mysqli':
                    while($linha = mysqli_fetch_assoc($res)){
                        $vet[] = $linha;
                    }
                    break;
            }


			return $vet;
		}


		public function result ($res, $lin, $col){
			switch($this->tipo){
				case 'mysql':
					$val = mysql_result($res, $lin, $col);
					break;

                case 'mysqli':
                    $val = mysqli_data_seek($res, $lin);
                    break;
				
				case 'pgsql':
					$val = pg_fetch_result($res, $lin, $col);
				    break;
			}
			
			return $val;
		}// fim public function result ($res, $lin, $col)


	}



?>