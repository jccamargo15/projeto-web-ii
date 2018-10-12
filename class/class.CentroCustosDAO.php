<?php 

require_once '../class/class.DbAdmin.php';
require_once 'class.CentroCustos.php;'

/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 */
class CentroCustosDAO
{
	private $dba;

	public function ContasDAO()
	{
		$dba = new DbAdmin('mysql');
		$dba->connect('localhost', 'root', '', 'contas');
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function cadastra($cen)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		// $id 		= $cen->getId();
		$nome 		= $cen->getNome();

		//cria comando SQL
		$query = 'INSERT INTO centro_custos (nome) VALUES ("'.$nome.'")';

		//executar comando SQL
		$dba->query($query);

	}


	public function lista()
	{
		$dba = $this->dba;

		$query = 'SELECT * FROM centro_custos';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<$num; $i++) { 
			$idc = $dba->result($res, $i, 'id');
			$nom = $dba->result($res, $i, 'nome');

			$cen = new CentroCustos();
			$cen->setId($idc);
			$cen->setNome($nom);

			$ver[] = $cen;
		}

		return $ver;
	}

	public function listaUm($cen)
	{
		$dba = $this->dba;

		$idc = $cen->getId();

		$query = 'SELECT * FROM centro_custos WHERE id = '.$idc;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<=$num; $i++) { 
			$idc = $dba->result($res, $i, 'id');
			$nom = $dba->result($res, $i, 'nome');

			$cen = new CentroCustos();
			$cen->setId($idc);
			$cen->setNome($nom);

			$ver[] = $cen;
		}

		return $ver;
	}

	public function excluir($cen)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$idc = $cen->getId();

		//cria comando SQL
		$query = 'DELETE FROM centro_custos WHERE id = "'.$idc.'"';

		//executar comando SQL
		$dba->query($query);

	}

	public function atualiza($cen)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$idc 		= $cen->getId();
		$nome 		= $cen->getNome();

		//cria comando SQL
		$query = 'UPDATE FROM centro_custos SET nome="'.$nome.'" WHERE id = "'.$idc.'"';

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>