<?php
	//classe de apostas que representa a tabela de usuarios no banco de dados
	class Material
	{
		private $id;
		private $descricao;
		private $situacao;
		private $id_hospital;

		public function __get($atributo){
			return $this->$atributo;
		}
		public function __set($atributo,$valor){
			return $this->$atributo=$valor;
		}
	}
?>