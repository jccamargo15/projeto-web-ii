<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	class CentroCustos{

		private $id;
		private $nome;

		public function CentroCustos(){
				//vazio, método construtor
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getId(){
			return $this->id;
		}

		public function getNome(){
			return $this->nome;
		}
	}
?>