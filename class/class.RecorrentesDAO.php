<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	require_once('../inc/class.DbAdmin.php');
	require_once('class.Recorrentes.php');


	class RecorrentesDAO{

		private $dba;

		public function RecorrentesDAO(){

			$dba = new DbAdmin('mysql');
			$dba->connect('localhost','root','','contas');

			$this->dba = $dba;
		}

		//método para inserir no banco
		public function cadastra($recorrentes){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id_centro_custos = $recorrentes->getIdCentroCustos();
			$id_conta = $recorrentes->getIdConta();
			$tipo_mov = $recorrentes->getTipoMov();
			$dia = $recorrentes->getDia();
			$descricao = $recorrentes->getDescricao();
			$valor = $recorrentes->getValor();
						
			//cria comando sql
			$query = 'INSERT INTO recorrentes (id_centro_custos, id_conta, tipo_mov, dia, descricao, valor)
						VALUES("'.$id_centro_custos.'","'.$id_conta.'","'.$tipo_mov.'","'.$dia.'","'.$descricao.'","'.$valor.'")';

			//executar comando sql
			$dba->query($query);
		}

		public function excluir($recorrentes){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id= $recorrentes->getId();

			//cria comando sql
			$query = 'DELETE FROM recorrentes 
						WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function atualiza($recorrentes){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id = $recorrentes->getId();
			$id_centro_custos = $recorrentes->getIdCentroCustos();
			$id_conta = $recorrentes->getIdConta();
			$tipo_mov = $recorrentes->getTipoMov();
			$dia = $recorrentes->getDia();
			$descricao = $recorrentes->getDescricao();
			$valor = $recorrentes->getValor();
						
			//cria comando sql
			$query = 'UPDATE FROM recorrentes 
						SET  id_centro_custos = "'.$id_centro_custos.'",
							 id_conta = "'.$id_conta.'",
							 tipo_mov = "'.$tipo_mov.'",
							 dia = "'.$dia.'",
							 descricao = "'.$descricao.'",
							 valor = "'.$valor.'",
					WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function lista(){

			$dba = $this->dba;

			$query = 'SELECT * FROM recorrentes';

			$res = $dba->query($query);

			$num = $dba->rows($res);

			for($i=0; $i<$num; $i++){

				$id = $dba->result($res,$i,'id');
				$id_centro_custos = $dba->result($res,$i,'id_centro_custos');
				$id_conta = $dba->result($res,$i,'id_conta');
				$tipo_mov = $dba->result($res,$i,'tipo_mov');
				$dia = $dba->result($res,$i,'dia');
				$descricao = $dba->result($res,$i,'descricao');
				$valor = $dba->result($res,$i,'valor');
								
				$recorrentes = new Recorrentes;

				$recorrentes->setId($id);
				$recorrentes->setIdCentroCustos($id_centro_custos);
				$recorrentes->setIdConta($id_conta);
				$recorrentes->setTipoMov($tipo_mov);
				$recorrentes->setDia($dia);
				$recorrentes->setDescricao($descricao);
				$recorrentes->setValor($valor);
								
				$vet[] = $recorrentes;

			}

			return $vet;

		}

}

?>