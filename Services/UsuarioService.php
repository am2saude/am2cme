<?php
	//classe contém as regras de negocio referente ao modelo de usuario
	class UsuarioService{

		public $usuario;
		public $conexao;

		public function __construct(Usuario $usuario,Conexao $conexao){
			$this->usuario=$usuario;
			$this->conexao=$conexao->conectar();
		}
		public function cadastrarUsuario(){
			$query="insert into tb_usuarios
			(nome,email,senha,id_hospital)
			values(:nome, :email, :senha, :id_hospital)";
			$insert=$this->conexao->prepare($query);
			$insert->bindValue(':nome',$this->usuario->__get('nome'));
			$insert->bindValue(':email',$this->usuario->__get('email'));
			$insert->bindValue(':senha',$this->usuario->__get('senha'));
			$insert->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$insert->execute();

		}
		public function Login(){
			$query="select * from tb_usuarios
			 where email = :email and senha = :senha";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':email',$this->usuario->__get('email'));
			$stmt->bindValue(':senha',$this->usuario->__get('senha'));
			$stmt->execute();
			return $stmt->fetch();
		}
		public function buscarEmailUsuario(){
			$query="select * from tb_usuarios 
			where email = :email";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':email',$this->usuario->__get('email'));			
			$stmt->execute();
			return $stmt->fetch();
		}

		public function listarUsuarios(){
			$query="select * from tb_usuarios 
			where id_hospital= :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function desativaUsuario(){
			$query="update tb_usuarios set situacao= 'inativo' where id = :id and id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->usuario->__get('id'));
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
		}
		public function ativaUsuario(){
			$query="update tb_usuarios set situacao= 'ativo' where id = :id and id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->usuario->__get('id'));
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
		}
		
		public function TotalUsuarios(){
			$query="select count(*) as total_usuarios from tb_usuarios 
			where id_hospital= :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
			return $stmt->fetch();
		}

		public function CadastrarUsuarioAdmin(){
			$query="insert into tb_usuarios(id_hospital,nome,email,senha,perfil)
			values(:id_hospital, :nome, :email, :senha, :perfil)";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->bindValue(':nome',$this->usuario->__get('nome'));
			$stmt->bindValue(':email',$this->usuario->__get('email'));
			$stmt->bindValue(':senha',$this->usuario->__get('senha'));
			$stmt->bindValue(':perfil',$this->usuario->__get('perfil'));
			$stmt->execute();
		}

		public function inativaMuitos(){
			$query="update tb_usuarios set situacao= 'inativo' where  id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
		}

		public function ativaMuitos(){
			$query="update tb_usuarios set situacao= 'ativo' where  id_hospital = :id_hospital";
			$stmt=$this->conexao->prepare($query);
			$stmt->bindValue(':id_hospital',$this->usuario->__get('id_hospital'));
			$stmt->execute();
		}
		
	}
?>