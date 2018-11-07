<?php 

include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");
//require_once '../inc/class.DbAdmin.php';
//include($_SERVER['DOCUMENT_ROOT']."/projeto-web2/class/class.Contas.php");
require_once 'class.Contas.php';

/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 * alterado por Jocemar Flores
 * em 14/10/2018
 */
class ContasDAO
{
	private $dba;

	public function ContasDAO()
	{
		$dba = new DbAdmin('mysql');
		$dba->connect('localhost', 'root', '', 'contas');
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function cadastra($con)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		// $id 		= $con->getId();
		$nome 		= $con->getNome();

		//cria comando SQL
		$query = 'INSERT INTO contas (nome) VALUES ("'.$nome.'")';

		//executar comando SQL
		$dba->query($query);

	}


	public function lista()
	{
		$dba = $this->dba;

		$query = 'SELECT * FROM contas ORDER BY nome';

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) { 
			$idc = $dba->result($res, $i, 'id');
			$nom = $dba->result($res, $i, 'nome');

			$con = new Contas();
			$con->setId($idc);
			$con->setNome($nom);

			$ver[] = $con;
		}

		return $ver;
	}

	public function listaUm($idc)
	{
		$dba = $this->dba;

		//$idc = $con->getId();

		$query = 'SELECT * FROM contas WHERE id = '.$idc;

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);



		//for ($i=0; $i<=$num; $i++) { 
			$idc = $dba->result($res, 0, 'id');
			$nom = $dba->result($res, 0, 'nome');

			$con = new Contas();
			$con->setId($idc);
			$con->setNome($nom);

			$ver[] = $con;
		//}

		return $ver;
	}

	public function excluir($con)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$idc = $con->getId();

		//cria comando SQL
		$query = 'DELETE FROM contas WHERE id = "'.$idc.'"';

		//executar comando SQL
		$dba->query($query);

	}

	public function atualiza($con)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$idc 		= $con->getId();
		$nome 		= $con->getNome();

		//cria comando SQL
		$query = 'UPDATE contas SET nome="'.$nome.'" WHERE id = "'.$idc.'"';

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>