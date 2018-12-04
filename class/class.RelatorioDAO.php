<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");
require_once 'class.Relatorio.php';

/**
 * classe que controla relatórios de categoria e extratos
 */
class RelatorioDAO
{
	private $dba;
	
	public function RelatorioDAO()
	{
		$dba = new DbAdmin('mysql');
		$dba->connect('localhost', 'root', '', 'contas');
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function extratoCatetoria($tipo, $mes, $ano, $carteira)
	{
		// pega conexão ativa
		$dba = $this->dba;

		$query = 'SELECT movimentacao.id, 
		movimentacao.tipo_mov, 
        movimentacao.data, 
        FORMAT(SUM(movimentacao.valor), 2, "de_DE") AS soma, 
        contas.nome AS conta, 
        contas.id,
        centro_custos.nome,
        movimentacao.descricao
		FROM movimentacao, contas, centro_custos
		WHERE movimentacao.id_conta = contas.id 
		AND movimentacao.id_centro_custos = centro_custos.id 
		AND movimentacao.tipo_mov = "'.$tipo.'" AND movimentacao.data LIKE "'.$ano.'-'.$mes.'-%"
		AND contas.id = '.$carteira.'
		GROUP BY centro_custos.nome';

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 		= $dba->result($res, $i, 'movimentacao.id'); 
			$tipo_mov	= $dba->result($res, $i, 'tipo_mov');
			$data 		= $dba->result($res, $i, 'data');
			$soma	 	= $dba->result($res, $i, 'soma');
			$conta 		= $dba->result($res, $i, 'conta');
			$conta_id 	= $dba->result($res, $i, 'contas.id');
			$categoria 	= $dba->result($res, $i, 'nome');
			$descricao 	= $dba->result($res, $i, 'descricao');

			$rel = new Relatorio();
			$rel->setTipo($tipo_mov);
			$rel->setCategoria($categoria);
			$rel->setSoma($soma);
			$rel->setCarteira($carteira);

			$ver[] = $rel;
		}

		return $ver;
	}

	public function extratoAnterior($tipo, $mes, $ano, $carteira)
	{
		// pega conexão ativa
		$dba = $this->dba;

		$query = 'SELECT movimentacao.id, 
		movimentacao.tipo_mov, 
        movimentacao.data, 
        SUM(movimentacao.valor) AS soma,
        contas.nome AS conta, 
        contas.id,
        centro_custos.nome,
        movimentacao.descricao

		FROM movimentacao, contas, centro_custos
		WHERE movimentacao.id_conta = contas.id 
		AND movimentacao.id_centro_custos = centro_custos.id 
		AND movimentacao.tipo_mov = "'.$tipo.'" AND movimentacao.data < "'.$ano.'-'.$mes.'-1"
		AND contas.id = '.$carteira;

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 		= $dba->result($res, $i, 'movimentacao.id'); 
			$tipo_mov	= $dba->result($res, $i, 'tipo_mov');
			$data 		= $dba->result($res, $i, 'data');
			$soma	 	= $dba->result($res, $i, 'soma');
			$conta 		= $dba->result($res, $i, 'conta');
			$conta_id 	= $dba->result($res, $i, 'contas.id');
			$categoria 	= $dba->result($res, $i, 'nome');
			$descricao 	= $dba->result($res, $i, 'descricao');

			$rel = new Relatorio();
			$rel->setTipo($tipo_mov);
			$rel->setCategoria($categoria);
			$rel->setSoma($soma);
			$rel->setCarteira($carteira);

			$ver[] = $rel;
		}

		return $ver;
	}

	public function extratoAtual($tipo, $mes, $ano, $carteira)
	{
		// pega conexão ativa
		$dba = $this->dba;

		$query = 'SELECT movimentacao.id, 
		movimentacao.tipo_mov, 
        movimentacao.data, 
        SUM(movimentacao.valor) AS soma,
        contas.nome AS conta, 
        contas.id,
        centro_custos.nome,
        movimentacao.descricao

		FROM movimentacao, contas, centro_custos
		WHERE movimentacao.id_conta = contas.id 
		AND movimentacao.id_centro_custos = centro_custos.id 
		AND movimentacao.tipo_mov = "'.$tipo.'" AND movimentacao.data LIKE "'.$ano.'-'.$mes.'-%"
		AND contas.id = '.$carteira;

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 		= $dba->result($res, $i, 'movimentacao.id'); 
			$tipo_mov	= $dba->result($res, $i, 'tipo_mov');
			$data 		= $dba->result($res, $i, 'data');
			$soma	 	= $dba->result($res, $i, 'soma');
			$conta 		= $dba->result($res, $i, 'conta');
			$conta_id 	= $dba->result($res, $i, 'contas.id');
			$categoria 	= $dba->result($res, $i, 'nome');
			$descricao 	= $dba->result($res, $i, 'descricao');

			$rel = new Relatorio();
			$rel->setTipo($tipo_mov);
			$rel->setCategoria($categoria);
			$rel->setSoma($soma);
			$rel->setCarteira($carteira);

			$ver[] = $rel;
		}

		return $ver;
	}

	public function extrato($mes, $ano, $carteira)
	{
		// pega conexão ativa
		$dba = $this->dba;

		$query = 'SELECT movimentacao.id, 
		movimentacao.tipo_mov, 
        DATE_FORMAT(movimentacao.data,"%d/%m/%Y") AS data, 
        FORMAT(movimentacao.valor, 2, "de_DE") AS valor,
        contas.nome AS conta, 
        contas.id,
        centro_custos.nome,
        movimentacao.descricao

		FROM movimentacao, contas, centro_custos
		WHERE movimentacao.id_conta = contas.id 
		AND movimentacao.id_centro_custos = centro_custos.id 
		AND movimentacao.data LIKE "'.$ano.'-'.$mes.'-%"
		AND contas.id = '.$carteira.' ORDER BY movimentacao.data';

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$id 		= $dba->result($res, $i, 'movimentacao.id'); 
			$tipo_mov	= $dba->result($res, $i, 'tipo_mov');
			$data 		= $dba->result($res, $i, 'data');
			$valor	 	= $dba->result($res, $i, 'valor');
			$conta 		= $dba->result($res, $i, 'conta');
			$conta_id 	= $dba->result($res, $i, 'contas.id');
			$categoria 	= $dba->result($res, $i, 'nome');
			$descricao 	= $dba->result($res, $i, 'descricao');

			$rel = new Relatorio();
			$rel->setTipo($tipo_mov);
			$rel->setCategoria($categoria);
			$rel->setValor($valor);
			$rel->setCarteira($carteira);
			$rel->setDescricao($descricao);

			$ver[] = $rel;
		}

		return $ver;
	}
}
?>