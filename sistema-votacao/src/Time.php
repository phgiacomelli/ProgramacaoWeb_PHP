<?php

class Time implements ActiveRecord
{

    private int $idTime;

    public function __construct(private string $nome)
    {
    }

    /* Id */
    public function setidTime(int $idTime): void
    {
        $this->idTime = $idTime;
    }

    public function getidTime(): int
    {
        return $this->idTime;
    }


    /* Nome */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->idTime)) {
            $sql = "UPDATE time SET nome = '{$this->nome}' WHERE idTime = '{$this->idTime}'";
        } else {
            $sql = "INSERT INTO time (nome) VALUES ('{$this->nome}')";
        }
        return $conexao->executa($sql);
    }
    public function delete(): bool
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM time WHERE idTime = '{$this->idTime}'";
        return $conexao->executa($sql);
    }

    public static function find($idTime): Time
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM time WHERE idTime = '{$idTime}'";
        $resultado = $conexao->consulta($sql);
        $t = new Time($resultado[0]['nome']);
        $t->setIdTime($resultado[0]['idTime']);
        return $t;
    }

    public static function findall(): array
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM time";
        $resultados = $conexao->consulta($sql);
        $times = array();
        foreach ($resultados as $resultado) {
            $t = new Time($resultado['nome']);
            $t->setidTime($resultado['idTime']);
            $times[] = $t;
        }
        return $times;
    }

    // public static function findallById($idTime): array
    // {
    //     $conexao = new MySQL();
    //     $sql = "SELECT * FROM time WHERE idTime = {$idTime}";
    //     $resultados = $conexao->consulta($sql);
    //     $times = array();
    //     foreach ($resultados as $resultado) {
    //         $t = new Time($resultado['nome']);
    //         $t->setIdTime($resultado['idTime']);
    //         $times[] = $t;
    //     }
    //     return $times;
    // }
}
