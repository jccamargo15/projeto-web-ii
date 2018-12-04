<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php

	class Movimentacao{

		private $id;
		private $id_centro_custos;
		private $id_conta;
		private $tipo_mov;
		private $data;
		private $descricao;
		private $valor;

		public function Movimentacao(){
				//vazio, método construtor
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setIdCentroCustos($id_centro_custos){
			$this->id_centro_custos = $id_centro_custos;
		}

		public function setIdConta($id_conta){
			$this->id_conta = $id_conta;
		}

		public function setTipoMov($tipo_mov){
			$this->tipo_mov = $tipo_mov;
		}

		public function setData($data){
			$this->data = $data;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function getId(){
			return $this->id;
		}

		public function getIdCentroCustos(){
			return $this->id_centro_custos;
		}

		public function getIdConta(){
			return $this->id_conta;
		}

		public function getTipoMov(){
			return $this->tipo_mov;
		}

		public function getData(){
			return $this->data;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function getValor(){
			return $this->valor;
		}
	}
?>