<!-- criado por Jocemar Flores em 14/10/18
	 atualizado por Jocemar Flores em 21/10/18
 -->
<?php
	
	require_once('../class/class.Movimentacao.php');
	require_once('../class/class.MovimentacaoDAO.php');


	if( $_GET['acao']=='excluir'){
		$tipo = $_GET['tipo'];

		$movimentacao = new Movimentacao();
		$movimentacao->setId($_GET['id']);
		
		$movimentacaoDAO = new MovimentacaoDAO();
		$movimentacaoDAO->excluir($movimentacao);

		if($tipo == 'credito'){
			header("Location: ../index.php?page=movimentacao_credito&confirm=3");
			exit();
		}

		if($tipo == 'debito'){
			header("Location: ../index.php?page=movimentacao_debito&confirm=3");
			exit();
		}

	}else{

		if( $_POST['acao']=='inserir'){

			$movimentacao = new Movimentacao();

			$movimentacao->setIdCentroCustos($_POST['id_centro_custos']);
			$movimentacao->setIdConta($_POST['id_conta']);
			$movimentacao->setTipoMov($_POST['tipo_mov']);
			$movimentacao->setData($_POST['data']);
			$movimentacao->setDescricao($_POST['descricao']);
			$movimentacao->setValor($_POST['valor']);
					
			$movimentacaoDAO = new MovimentacaoDAO();
			$movimentacaoDAO->cadastra($movimentacao);

			if($_POST['tipo_mov'] == 'credito'){
				header("Location: ../index.php?page=movimentacao_credito&confirm=1");
				exit();
			}
			if($_POST['tipo_mov'] == 'debito'){
				header("Location: ../index.php?page=movimentacao_debito&confirm=1");
				exit();
			}

		}

		if( $_POST['acao']=='editar'){

			$movimentacao= new Movimentacao();

			$movimentacao->setId($_POST['id']);
			$movimentacao->setIdConta($_POST['id_conta']);
			$movimentacao->setIdCentroCustos($_POST['id_centro_custos']);
			$movimentacao->setTipoMov($_POST['tipo_mov']);
			$movimentacao->setData($_POST['data']);
			$movimentacao->setDescricao($_POST['descricao']);
			$movimentacao->setValor($_POST['valor']);

			$movimentacaoDAO = new MovimentacaoDAO();
			$movimentacaoDAO->atualiza($movimentacao);

			if($_POST['tipo_mov'] == 'credito'){
				header("Location: ../index.php?page=movimentacao_credito&confirm=2");
				exit();
			}
			if($_POST['tipo_mov'] == 'debito'){
				header("Location: ../index.php?page=movimentacao_debito&confirm=2");
				exit();
			}

			

		}


	}	
?>