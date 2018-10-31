<?php

/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 * atualizado por Jocemar Flores em 21/10/18
 * atualizado por José Carlos 30/10/2018
 */

include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");
require_once 'class.Movimentacao.php';
require_once '../inc/config.php';

class MovimentacaoDAO
{
	private $dba;

	public function MovimentacaoDAO()
	{
		$dba = new DbAdmin(DB_TYPE);
		$dba->connect(DB_SERVER,DB_USER,DB_PASSWD,DB_NAME);
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function cadastra($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id_centro_custos 	= $mov->getIdCentroCustos();
		$id_conta 			= $mov->getIdConta();
		$tipo_mov 			= $mov->getTipoMov();
		$data				= $mov->getData();
		$descricao			= $mov->getDescricao();
		$valor				= $mov->getValor();

		//cria comando SQL
		$query = 'INSERT INTO movimentacao (id_centro_custos, id_conta, tipo_mov, data, descricao, valor) VALUES ('.$id_centro_custos.', '.$id_conta.', "'.$tipo_mov.'", "'.$data.'", "'.$descricao.'", '.$valor.')';

		//executar comando SQL
		$dba->query($query);

	}


	public function lista($tipo)
	{
		$dba = $this->dba;

		//$query = 'SELECT * FROM movimentacao';
		$query = 'SELECT movimentacao.id, movimentacao.tipo_mov, movimentacao.data, movimentacao.descricao, 
						movimentacao.valor, contas.nome, centro_custos.nome
				  FROM movimentacao, contas, centro_custos
				  WHERE movimentacao.id_conta = contas.id 
				        AND movimentacao.id_centro_custos = centro_custos.id 
				        AND movimentacao.tipo_mov = "'.$tipo.'"';

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 			 	= $dba->result($res, $i, 'id'); 
			$id_centro_custos 	= $dba->result($res, $i, 'centro_custos.nome');
			$id_conta 			= $dba->result($res, $i, 'contas.nome');
			$tipo_mov 			= $dba->result($res, $i, 'tipo_mov');
			$data 				= $dba->result($res, $i, 'data');
			$descricao 			= $dba->result($res, $i, 'descricao');
			$valor 				= $dba->result($res, $i, 'valor');

			$mov = new Movimentacao();
			$mov->setId($id);
			$mov->setIdCentroCustos($id_centro_custos);
			$mov->setIdConta($id_conta);
			$mov->setTipoMov($tipo_mov);
			$mov->setData($data);
			$mov->setDescricao($descricao);
			$mov->setValor($valor);

			$ver[] = $mov;
		}

		return $ver;
	}

	public function listaUm($id)
	{
		$dba = $this->dba;

		$query = 'SELECT * FROM movimentacao WHERE id = '.$id;

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 			 	= $dba->result($res, $i, 'id'); 
			$id_centro_custos 	= $dba->result($res, $i, 'id_centro_custos');
			$id_conta 			= $dba->result($res, $i, 'id_conta');
			$tipo_mov 			= $dba->result($res, $i, 'tipo_mov');
			$data 				= $dba->result($res, $i, 'data');
			$descricao 			= $dba->result($res, $i, 'descricao');
			$valor 				= $dba->result($res, $i, 'valor');

			$mov = new Movimentacao();
			$mov->setId($id);
			$mov->setIdCentroCustos($id_centro_custos);
			$mov->setIdConta($id_conta);
			$mov->setTipoMov($tipo_mov);
			$mov->setData($data);
			$mov->setDescricao($descricao);
			$mov->setValor($valor);

			$ver[] = $mov;
		}

		return $ver;
	}

	public function excluir($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id = $mov->getId();
		$tipo = $mov->getTipoMov();

		//cria comando SQL
		$query = 'DELETE FROM movimentacao WHERE id = "'.$id.'"';

		//executar comando SQL
		$dba->query($query);

		return $tipo;

	}

	public function atualiza($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id 				= $mov->getId();
		$id_centro_custos 	= $mov->getIdCentroCustos();
		$id_conta 			= $mov->getIdConta();
		$tipo_mov 			= $mov->getTipoMov();
		$data				= $mov->getData();
		$descricao			= $mov->getDescricao();
		$valor				= $mov->getValor();


		//cria comando SQL
		$query = 'UPDATE movimentacao SET id_centro_custos="'.$id_centro_custos.'", id_conta="'.$id_conta.'",  tipo_mov="'.$tipo_mov.'",  data="'.$data.'",  descricao="'.$descricao.'", valor="'.$valor.'"  WHERE id = "'.$id.'"';

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>