<!-- criado por Jocemar Flores em 22/11/18
 -->
 
<?php 

include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");
require_once 'class.ExtratoCarteira.php';

class ExtratoCarteiraDAO
{
	private $dba;

	public function ExtratoCarteiraDAO()
	{
		$dba = new DbAdmin('mysql');
		$dba->connect('localhost', 'root', '', 'contas');
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function extrato_carteira($conta, $ano, $mes){

		$dba = $this->dba;

		$query = 'SELECT contas.nome, DATE_FORMAT(movimentacao.data,"%d/%m/%Y") as data_formatada, movimentacao.tipo_mov, FORMAT(movimentacao.valor, 2, "de_DE") as valor_formatado, SUM(movimentacao.valor) 
				  FROM contas, movimentacao
				  WHERE contas.id = movimentacao.id_conta AND contas.id = "'.$conta.'" AND LIKE movimentacao.data LIKE "'.$ano.'-'.$mes.'-%"';
		

		$res = $dba->query($query);

		$num = $dba->linhas_consulta($res);

		for ($i=0; $i<$num; $i++) {
			$conta 			 	= $dba->result($res, $i, 'contas.nome'); 
			$data 	            = $dba->result($res, $i, 'data_formatada');
			$valor 	            = $dba->result($res, $i, 'valor_formatado');
			$tipo_mov		    = $dba->result($res, $i, 'movimentacao.tipo');
			
			$extr = new ExtratoCarteira();
			$extr->setConta($conta);
			$extr->setData($data);
			$extr->setValor($valor);
			$extr->setTipoMov($tipo_mov);
			
			$ver[] = $extr;
		}

		return $ver;
	}

}

?>