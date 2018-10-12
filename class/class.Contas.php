<?php
	/*
	* Classe criada por Jocemar Flores em 04/10/2018
	*/

	class Contas{

		private $id;
		private $nome;

		public function Contas(){
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