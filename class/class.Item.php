<?php
	/*
	* Classe criada por Jocemar Flores em 04/10/2018
	*/

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