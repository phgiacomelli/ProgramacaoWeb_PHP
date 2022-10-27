<?php

class Voto implements ActiveRecord{

    private int $idUsuario;
    private int $idTime;

    
    public function __construct(){
    }

    /* IdUsuario */
    public function setIdUsuario(int $idUsuario):void{
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario():int{
        return $this->idUsuario;
    }

    /* IdTime */
    public function setIdTime(int $idTime):void{
        $this->idTime = $idTime;
    }

    public function getIdTime():int{
        return $this->idTime;
    }
    
    public function save():bool{
        $conexao = new MySQL();
        $sql = "INSERT INTO voto (idUsuario,idTime) VALUES ('{$this->idUsuario}','{$this->idTime}')";
        return $conexao->executa($sql);
    }

    public static function find($idUsuario):Voto{
        // $conexao = new MySQL();
        // $sql = "SELECT * FROM usuario WHERE idUsuario = {$idUsuario}";
        // $resultado = $conexao->consulta($sql);
        // $u = new Usuario($resultado[0]['nome'],$resultado[0]['email'],$resultado[0]['senha']);
        // $u->setIdUsuario($resultado[0]['idUsuario']);
        return new Voto();
    }

    public function delete():bool{
        // $conexao = new MySQL();
        // $sql = "DELETE FROM usuario WHERE idUsuario = {$this->idUsuario}";
        // return $conexao->executa($sql);
        return true;
    }

    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM voto";
        $resultados = $conexao->consulta($sql);
        $votos = array();
        foreach($resultados as $resultado){
            $v = new Voto();
            $v->setIdUsuario($resultado['idUsuario']);
            $v->setIdTime($resultado['idTime']);
            $votos[] = $v;
        }
        return $votos;
    }

    public static function findallByUsuario($idUsuario): array
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM voto WHERE idUsuario = '{$idUsuario}'";
        $resultados = $conexao->consulta($sql);
        $votos = array();
        foreach ($resultados as $resultado) {
            $v = new Voto();
            $v->setIdTime($resultado['idTime']);
            $v->setIdUsuario($resultado['idUsuario']);
            $votos[] = $v;
        }
        return $votos;
    }

    public static function findallByTime($idTime): array
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM voto WHERE idTime = '{$idTime}'";
        $resultados = $conexao->consulta($sql);
        $votos = array();
        foreach ($resultados as $resultado) {
            $v = new Voto();
            // var_dump($resultado['idUsuario']);
            // $v->setIdUsuario($resultado['idUsuario']);
            $v->setIdTime($resultado['idTime']);
            $votos[] = $v;
        }

        return $votos;
    }
}
