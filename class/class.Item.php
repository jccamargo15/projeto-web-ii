<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	class Item{

		private $id;
		private $descricao;

		public function Item(){
				//vazio, método construtor
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function getId(){
			return $this->id;
		}

		public function getDescricao(){
			return $this->descricao;
		}
	}
?>