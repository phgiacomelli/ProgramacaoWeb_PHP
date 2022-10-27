<?php

class Usuario implements ActiveRecord{

    private int $idUsuario;
    
    public function __construct(private string $nome, private string $email,private string $senha){
    }

    /* Id */
    public function setIdUsuario(int $idUsuario):void{
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario():int{
        return $this->idUsuario;
    }


    /* Nome */
    public function setNome(string $nome):void{
        $this->nome = $nome;
    }

    public function getNome():string{
        return $this->nome;
    }
    
    /* Senha */
    public function setSenha(string $senha):void{
        $this->senha = $senha;
    }

    public function getSenha():string{
        return $this->senha;
    }


    /* Email */
    public function setEmail(string $email):void{
        $this->email = $email;
    }

    public function getEmail():string{
        return $this->email;
    }

    
    public function save():bool{
        $conexao = new MySQL();
        $this->senha = password_hash($this->senha,PASSWORD_BCRYPT); 
        if(isset($this->idUsuario)){
            $sql = "UPDATE usuario SET nome = '{$this->nome}' ,email = '{$this->email}' ,senha = '{$this->senha}' WHERE idUsuario = '{$this->idUsuario}'";
        }else{
            $sql = "INSERT INTO usuario (nome,email,senha) VALUES ('{$this->nome}','{$this->email}','{$this->senha}')";
        }
        return $conexao->executa($sql);
    }

    public static function find($idUsuario):Usuario{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE idUsuario = '{$idUsuario}'";
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['nome'],$resultado[0]['email'],$resultado[0]['senha']);
        $u->setIdUsuario($resultado[0]['idUsuario']);
        return $u;
    }

    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM usuario WHERE idUsuario = '{$this->idUsuario}'";
        return $conexao->executa($sql);
    }

    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario";
        $resultados = $conexao->consulta($sql);
        $usuarios = array();
        foreach($resultados as $resultado){
            $u = new Usuario($resultado[0]['nome'],$resultado['email'],$resultado['senha']);
            $u->setIdUsuario($resultado['idUsuario']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }

    public static function findByEmail($email):Usuario{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE email = '{$email}'";
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['nome'],$resultado[0]['email'],$resultado[0]['senha']);
        $u->setIdUsuario($resultado[0]['idUsuario']);
        return $u;
    }


    public function authenticate():bool{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);
        if(password_verify($this->senha,$resultados[0]['senha'])){
            session_start();
            $_SESSION['idUsuario'] = $resultados[0]['idUsuario'];
            $_SESSION['nome'] = $resultados[0]['nome'];
            return true;
        }else{
            return false;
        }
    }
}
