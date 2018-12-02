<?php
	/**
	 * classe que controla os relatórios por categoria e exetratos
	 */
	class Relatorio
	{
		private $tipo;
		private $carteira;
		private $mes;
		private $ano;

		private $data;
		private $soma;
		private $categoria;
		private $descricao;
		
		public function Relatorio()
		{
			# code...
		}

		public function setTipo($tipo)
		{
			$this->tipo = $tipo;
		}

		public function setCarteira($carteira)
		{
			$this->carteira = $carteira;
		}

		public function setMes($mes)
		{
			$this->mes = $mes;
		}

		public function setAno($ano)
		{
			$this->ano = $ano;
		}

		public function setData($data)
		{
			$this->data = $data;
		}

		public function setSoma($soma)
		{
			$this->soma = $soma;
		}

		public function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}

		public function setDescricao($descricao)
		{
			$this->descricao = $descricao;
		}

		public function getTipo()
		{
			return $this->tipo;
		}

		public function getCarteira()
		{
			return $this->carteira;
		}

		public function getMes()
		{
			return $this->mes;
		}

		public function getAno()
		{
			return $this->ano;
		}

		public function getData()
		{
			return $this->data;
		}

		public function getSoma()
		{
			return $this->soma;
		}

		public function getCategoria()
		{
			return $this->categoria;
		}

		public function getDescricao()
		{
			return $this->descricao;
		}
	}
?>