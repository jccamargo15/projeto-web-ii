<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	
	require_once('../class/class.CentroCustos.php');
	require_once('../class/class.CentroCustosDAO.php');

	if( $_GET['acao']=='excluir'){

		$CentroCustos = new CentroCustos();
		$CentroCustos->setId($_GET['id']);

		$CentroCustosDAO = new CentroCustosDAO();
		$CentroCustosDAO->excluir($CentroCustos);

		header("Location: ../index.php?page=cadastro_categoria&confirm=3");
		exit();

	}else{

		if( $_POST['acao']=='inserir'){

			$centroCustos = new CentroCustos();

			$centroCustos->setNome($_POST['nome']);
					
			$centroCustosDAO = new CentroCustosDAO();
			$centroCustosDAO->cadastra($centroCustos);

			header("Location: ../index.php?page=cadastro_categoria&confirm=1");
			exit();

		}

		if( $_POST['acao']=='editar'){

			$centroCustos = new CentroCustos();

			$centroCustos->setId($_POST['id']);
			$centroCustos->setNome($_POST['nome']);
					
			$centroCustosDAO = new CentroCustosDAO();
			$centroCustosDAO->atualiza($centroCustos);

			header("Location: ../index.php?page=cadastro_categoria&confirm=2");
			exit();

		}


	}	
?>