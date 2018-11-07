<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	require_once('../inc/class.DbAdmin.php');
	require_once('class.Parcelas.php');


	class ParcelasDAO{

		private $dba;

		public function ParcelasDAO(){

			$dba = new DbAdmin('mysql');
			$dba->connect('localhost','root','','contas');

			$this->dba = $dba;
		}

		//método para inserir no banco
		public function cadastra($parcelas){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id_centro_custos = $parcelas->getIdCentroCustos();
			$id_conta = $parcelas->getIdConta();
			$id_item = $parcelas->getIdItem();
			$tipo_mov = $parcelas->getTipoMov();
			$parcela = $parcelas->getParcela();
			$vencimento = $parcelas->getVencimento();
			$valor = $parcelas->getValor();
			$status_pagamento = $parcelas->getStatusPagamento();
			
			//cria comando sql
			$query = 'INSERT INTO parcelas (id_centro_custos, id_conta, id_item, tipo_mov, parcela, vencimento, valor, status_pagamento)
						VALUES("'.$id_centro_custos.'","'.$id_conta.'","'.$id_item.'","'.$tipo_mov.'","'.$parcela.'","'.$vencimento.'","'.$valor.'","'.$status_pagamento.'",)';

			//executar comando sql
			$dba->query($query);
		}

		public function excluir($parcelas){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id= $parcelas->getId();

			//cria comando sql
			$query = 'DELETE FROM parcelas 
						WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function atualiza($parcelas){

			//atribui o atributo de classe para a variavel
			$dba = $this->dba;

			//retira os dados de dentro do obj
			$id = $parcelas->getId();
			$id_centro_custos = $parcelas->getIdCentroCustos();
			$id_conta = $parcelas->getIdConta();
			$id_item = $parcelas->getIdItem();
			$tipo_mov = $parcelas->getTipoMov();
			$parcela = $parcelas->getParcela();
			$vencimento = $parcelas->getVencimento();
			$valor = $parcelas->getValor();
			$status_pagamento = $parcelas->getStatusPagamento();
			
			//cria comando sql
			$query = 'UPDATE FROM parcelas 
						SET  id_centro_custos = "'.$id_centro_custos.'",
							 id_conta = "'.$id_conta.'",
							 id_item = "'.$id_item.'",
							 tipo_mov = "'.$tipo_mov.'",
							 parcela = "'.$parcela.'",
							 vencimento = "'.$vencimento.'",
							 valor = "'.$valor.'",
							 status_pagamento = "'.$status_pagamento.'",
						WHERE id = "'.$id.'"';

			//executar comando sql
			$dba->query($query);
		}

		public function lista(){

			$dba = $this->dba;

			$query = 'SELECT * FROM parcelas';

			$res = $dba->query($query);

			$num = $dba->rows($res);

			for($i=0; $i<$num; $i++){

				$id = $dba->result($res,$i,'id');
				$id_centro_custos = $dba->result($res,$i,'id_centro_custos');
				$id_conta = $dba->result($res,$i,'id_conta');
				$id_item = $dba->result($res,$i,'id_item');
				$tipo_mov = $dba->result($res,$i,'tipo_mov');
				$parcela = $dba->result($res,$i,'parcela');
				$vencimento = $dba->result($res,$i,'vencimento');
				$valor = $dba->result($res,$i,'valor');
				$status_pagamento = $dba->result($res,$i,'status_pagamento');
				
				$parcelas = new Parcelas;

				$parcelas->setId($id);
				$parcelas->setIdCentroCustos($id_centro_custos);
				$parcelas->setIdConta($id_conta);
				$parcelas->setIdItem($id_item);
				$parcelas->setTipoMov($tipo_mov);
				$parcelas->setParcela($parcela);
				$parcelas->setVencimento($vencimento);
				$parcelas->setValor($valor);
				$parcelas->setStatusPagamento($status_pagamento);
				
				$vet[] = $parcelas;

			}

			return $vet;

		}

}

?>