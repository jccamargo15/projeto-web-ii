<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php

include_once($_SERVER['DOCUMENT_ROOT']."/projeto-web2/inc/class.DbAdmin.php");

function extratoCatetoria($tipo, $mes, $ano, $carteira) {

	$dba = new DbAdmin('mysql');
	$dba->connect('localhost', 'root', '', 'contas');

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

	$res = $dba->lista_query($res);

	return $res;
}

function extratoAnterior($tipo, $mes, $ano, $carteira) {

	$dba = new DbAdmin('mysql');
	$dba->connect('localhost', 'root', '', 'contas');

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

	$res = $dba->lista_query($res);

	return $res;
}

function extratoAtual($tipo, $mes, $ano, $carteira) {

	$dba = new DbAdmin('mysql');
	$dba->connect('localhost', 'root', '', 'contas');

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

	$res = $dba->lista_query($res);

	return $res;
}

function extrato($mes, $ano, $carteira) {

	$dba = new DbAdmin('mysql');
	$dba->connect('localhost', 'root', '', 'contas');

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

	$res = $dba->lista_query($res);

	return $res;
}
?>