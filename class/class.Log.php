<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	class Log{

		private $dir;
		private $arq;

		public function Log(){
				$this->dir = '../log/';
				$this->arq = $this->dir . 'log_movimentacao.txt';
		}

		public function abrirArquivo(){
			
			$fo = fopen($this->arq, 'a');
			return $fo;
		}

		public function escreverArquivo($msg){
			$fo = $this->abrirArquivo();
			fwrite($fo, $msg);
			fclose($this->arq);
		}
	}
?>