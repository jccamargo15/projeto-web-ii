<?php
	/*
	* Classe criada por José Camargo em 04/10/2018
	*/

	require_once('../inc/class.DbAdmin.php');
	require_once('class.Item.php');


	class ItemDAO{

		private $dba;

		public function ItemDAO(){

			$dba = new DbAdmin('mysql');
			$dba->connect('localhost','root','','contas');

			$this->dba = $dba;
		}

		//método para inserir no banco
		public function cadastra($item){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$descricao = $item->getDescricao();
			
			//cria comando sql
			$query = 'INSERT INTO item (descricao)
						VALUES("'.$descricao.'")';

			//executar comando sql
			$dba->query($query);
		}

		public function excluir($item){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id= $item->getId();

			//cria comando sql
			$query = 'DELETE FROM item 
						WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function atualiza($item){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id = $item->getId();
			$descricao = $item->getDescricao();
			
			//cria comando sql
			$query = 'UPDATE FROM item 
						SET  descricao = "'.$descricao.'",
						WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function lista(){

			$dba = $this->dba;

			$query = 'SELECT * FROM item';

			$res = $dba->query($query);

			$num = $dba->rows($res);

			for($i=0; $i<$num; $i++){

				$id = $dba->result($res,$i,'id');
				$descricao = $dba->result($res,$i,'descricao');
				
				$item = new Item;

				$item->setId($id);
				$item->setDescricao($descricao);
				
				$vet[] = $item;

			}

			return $vet;

		}

}

?>