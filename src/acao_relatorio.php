<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php

include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");

echo 'AQUI';

function extratoCatetoria($tipo, $mes, $ano, $carteira) {
	$dba = $this->dba;

	$query = 'SELECT movimentacao.id, 
		movimentacao.tipo_mov, 
        movimentacao.data, 
        SUM(movimentacao.valor), 
        contas.nome, 
        centro_custos.nome

FROM movimentacao, contas, centro_custos
WHERE movimentacao.id_conta = contas.id 
AND movimentacao.id_centro_custos = centro_custos.id 
AND movimentacao.tipo_mov = "debito" AND movimentacao.data LIKE "'.$ano.'-'.$mes.'-%"
GROUP BY centro_custos.nome';
}
?>