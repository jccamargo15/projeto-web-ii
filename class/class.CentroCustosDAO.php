 <!--
 * criado por José Carlos de camargo
 * em 04/10/2018
 * alterado por Jocemar Flores
 * em 14/10/2018
 -->

<?php
/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 * alterado por Jocemar Flores
 * em 14/10/2018
 * alterado por José Carlos
 * em 30/10/2018
 */
include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");
//require_once '../class/class.DbAdmin.php';
require_once 'class.CentroCustos.php';
require_once '../inc/config.php';

class CentroCustosDAO
{
	private $dba;

	public function CentroCustosDAO()
	{
		$dba = new DbAdmin(DB_TYPE);
		$dba->connect(DB_SERVER,DB_USER,DB_PASSWD,DB_NAME);
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

		$query = 'SELECT * FROM centro_custos ORDER BY nome';

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

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

	public function listaUm($idc)
	{
		$dba = $this->dba;

		//$idc = $cen->getId();

		$query = 'SELECT * FROM centro_custos WHERE id = '.$idc;

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		//for ($i=0; $i<=$num; $i++) { 
			$idc = $dba->result($res, 0, 'id');
			$nom = $dba->result($res, 0, 'nome');

			$cen = new CentroCustos();
			$cen->setId($idc);
			$cen->setNome($nom);

			$ver[] = $cen;
		//}

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
		$query = 'UPDATE centro_custos SET nome="'.$nome.'" WHERE id = "'.$idc.'"';

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>