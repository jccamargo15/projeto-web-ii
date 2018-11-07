<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	
	require_once('../class/class.Contas.php');
	require_once('../class/class.ContasDAO.php');

	if( $_GET['acao']=='excluir'){

		$contas = new Contas();
		$contas->setId($_GET['id']);

		$contasDAO = new ContasDAO();
		$contasDAO->excluir($contas);

		header("Location: ../index.php?page=cadastro_conta&confirm=3");
		exit();

	}else{

		if( $_POST['acao']=='inserir'){

			$contas = new Contas();

			$contas->setNome($_POST['nome']);
					
			$contasDAO = new ContasDAO();
			$contasDAO->cadastra($contas);

			header("Location: ../index.php?page=cadastro_conta&confirm=1");
			exit();

		}

		if( $_POST['acao']=='editar'){

			$contas = new Contas();

			$contas->setId($_POST['id']);
			$contas->setNome($_POST['nome']);
					
			$contasDAO = new ContasDAO();
			$contasDAO->atualiza($contas);

			header("Location: ../index.php?page=cadastro_conta&confirm=2");
			exit();

		}


	}	
?>