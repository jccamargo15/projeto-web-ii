<!-- criado por Jocemar Filho
    em 21/10/18 -->

<?php
	
	require_once('../class/class.Item.php');
	require_once('../class/class.ItemDAO.php');

	if( $_GET['acao']=='excluir'){

		$item = new Item();
		$item->setId($_GET['id']);

		$itemDAO = new ItemDAO();
		$itemDAO->excluir($item);

		header("Location: ../index.php?page=cadastro_item&confirm=3");
		exit();

	}else{

		if( $_POST['acao']=='inserir'){

			$item = new Item();

			$item->setDescricao($_POST['descricao']);
					
			$itemDAO = new itemDAO();
			$itemDAO->cadastra($item);

			header("Location: ../index.php?page=cadastro_item&confirm=1");
			exit();

		}

		if( $_POST['acao']=='editar'){

			$item = new Item();

			$item->setId($_POST['id']);
			$item->setDescricao($_POST['descricao']);
					
			$itemDAO = new ItemDAO();
			$itemDAO->atualiza($item);

			header("Location: ../index.php?page=cadastro_item&confirm=2");
			exit();

		}


	}	
?>