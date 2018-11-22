<?php
	/*
	* Classe criada por Jocemar Flores em 22/11/2018
	*/

	class ExtratoCarteira{

		private $conta;
		private $data;
		private $tipo_mov;
		private $valor;
		private $soma;
		
		public function ExtratoCarteira(){
				//vazio, método construtor
		}

		public function setConta($conta){
			$this->conta = $conta;
		}
		public function setData($data){
			$this->data = $data;
		}
		public function setTipoMov($tipo_mov){
			$this->tipo_mov = $tipo_mov;
		}
		public function setValor($valor){
			$this->valor = $valor;
		}
		public function setSoma($soma){
			$this->soma = $soma;
		}

		
		public function getConta(){
			return $this->conta;
		}
		public function getData(){
			return $this->data;
		}
		public function getAno(){
			return $this->ano;
		}
		public function getTipoMov(){
			return $this->tipo_mov;
		}
		public function getValor(){
			return $this->valor;
		}
		public function getSoma(){
			return $this->soma;
		}
	}
?>