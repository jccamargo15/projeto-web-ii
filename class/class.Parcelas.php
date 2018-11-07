<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	class Parcelas{

		private $id;
		private $id_centro_custos;
		private $id_conta;
		private $id_item;
		private $tipo_mov;
		private $parcela;
		private $vencimento;
		private $valor;
		private $status_pagamento;

		public function Parcelas(){
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

		public function setIdItem($id_item){
			$this->id_item = $id_item;
		}

		public function setTipoMov($tipo_mov){
			$this->tipo_mov = $tipo_mov;
		}

		public function setParcela($parcela){
			$this->parcela = $parcela;
		}

		public function setVencimento($vencimento){
			$this->vencimento = $vencimento;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function setStatusPagamento($status_pagamento){
			$this->status_pagamento = $status_pagamento;
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

		public function getIdItem(){
			return $this->id_item;
		}

		public function getTipoMov(){
			return $this->tipo_mov;
		}

		public function getParcela(){
			return $this->parcela;
		}

		public function getVencimento(){
			return $this->vencimento;
		}

		public function getValor(){
			return $this->valor;
		}

		public function getStatusPagamento(){
			return $this->status_pagamento;
		}
	}
?>