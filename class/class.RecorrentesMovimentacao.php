<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	class RecorrentesMovimentacao{

		private $id_recorrentes;
		private $id_movimentacao;


		public function RecorrentesMovimentacao(){
				//vazio, método construtor
		}

		public function setIdRecorrentes($id){
			$this->id_recorrentes = $id_recorrentes;
		}

		public function setIdMovimentacao($id_movimentacao){
			$this->id_movimentacao = $id_movimentacao;
		}

		public function getIdRecorrentes(){
			return $this->id_recorrentes;
		}

		public function getIdMovimentacao(){
			return $this->id_movimentacao;
		}
	}
?>