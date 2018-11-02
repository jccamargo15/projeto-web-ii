<?php 

/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 * alterado por José Carlos
 * em 30/10/2018
 */

// require_once 'class.DbAdmin.php';
require_once 'class.RecorrentesMovimentacao.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/projeto-web2/inc/config.php';

class RecorrentesMovimentacaoDAO
{
	private $dba;

	public function RecorrentesMovimentacaoDAO()
	{
		$dba = new DbAdmin(DB_TYPE);
		$dba->connect(DB_SERVER,DB_USER,DB_PASSWD,DB_NAME);
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function cadastra($recmov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id_recorrentes 	= $recmov->getIdRecorrentes();
		$id_movimentacao 	= $recmov->getIdMovimentacao();

		//cria comando SQL
		$query = 'INSERT INTO recorrentes_movimentecao (id_recorrentes, id_movimentacao) VALUES ('.$id_recorrentes.', '.$id_movimentacao.')';

		//executar comando SQL
		$dba->query($query);

	}


	public function lista()
	{
		$dba = $this->dba;

		$query = 'SELECT * FROM recorrentes_movimentacao';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<$num; $i++) { 
			$id_recorrentes = $dba->result($res, $i, 'id_recorrentes');
			$id_movimentacao = $dba->result($res, $i, 'id_movimentacao');

			$recmov = new RecorrentesMovimentacao();
			$recmov->setIdRecorrentes($id_recorrentes);
			$recmov->setIdMovimentacao($id_movimentacao);

			$ver[] = $recmov;
		}

		return $ver;
	}

	public function listaUm($recmov)
	{
		$dba = $this->dba;

		$idc = $recmov->getIdcliente();

		$query = 'SELECT * FROM recorrentes_movimentacao WHERE id_movimentacao = '.$id_movimentacao;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<=$num; $i++) { 
			$idc = $dba->result($res, $i, 'id_cliente');
			$nom = $dba->result($res, $i, 'nome');
			$ema = $dba->result($res, $i, 'email');
			$tel = $dba->result($res, $i, 'telefone');

			$recmov = new Cliente();
			$recmov->setIdcliente($idc);
			$recmov->setIdcliente($nom);
			$recmov->setIdcliente($ema);
			$recmov->setIdcliente($tel);

			$ver[] = $recmov;
		}

		return $ver;
	}

	public function exlcuir($recmov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id_recorrentes 	= $recmov->getIdRecorrentes();
		$id_movimentacao 	= $recmov->getIdMovimentacao();

		//cria comando SQL
		$query = 'DELETE FROM recorrentes_movimentacao WHERE id_movimentacao = "'.$id_movimentacao.'"';

		//executar comando SQL
		$dba->query($query);

	}

	public function atualiza($recmov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id_recorrentes 	= $recmov->getIdRecorrentes();
		$id_movimentacao 	= $recmov->getIdMovimentacao();

		//cria comando SQL
		$query = 'UPDATE FROM recorrentes_movimentacao SET id_recorrentes='.$id_recorrentes.', id_movimentacao='.$id_movimentacao.'  WHERE id_recorrentes='.$id_recorrentes.', id_movimentacao='.$id_movimentacao;

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>