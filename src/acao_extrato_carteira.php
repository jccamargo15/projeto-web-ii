<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	
	require_once('../class/class.ExtratoCarteira.php');
	require_once('../class/class.ExtratoCarteiraDAO.php');



	if( $_POST['acao']=='extrato_carteira'){

		//$extrato = new ExtratoCarteira();
		
		$conta = $_POST['id_conta'];
		$mes = $_POST['mesFiltro'];
		$ano = $_POST['anoFiltro'];
				
		$extratoDAO = new ExtratoCarteiraDAO();
		$extratoDAO->extrato_carteira($conta, $mes, $ano);

	}



	}	
?>