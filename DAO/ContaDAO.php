<?php


namespace PHPBancoDigital\DAO;
use PHPBancoDigital\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO
{
    public function __construct()
    {
        return parent::__construct();    
    }

    public function insert (ContaModel $model)
    {
        $sql = "INSERT INTO conta (numero, id_correntista, tipo, saldo, limite) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->numero);
        $stmt->bindValue(5, $model->id_correntista);
        $stmt->execute();

    }

    public function update(ContaModel $model)
    {
        $sql = "UPDATE conta SET numero=?, tipo=?, id_correntista=?, saldo=?, limite=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->tipo);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->numero);
        $stmt->bindValue(5, $model->id_correntista);
        $stmt->bindValue(6, $model->id);
        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM conta";

        $stmt=$this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById(int $id)
    {
        include_once 'Model/ContaModel.php';

        $sql = "SELECT id, tipo, saldo, limite, numero, id_correntista FROM conta WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("ApiBancoDigital\Model\ContaModel");
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM conta WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function selectByIdCorrentista(int $id_correntista) : array
    {
        
        $sql = "SELECT * FROM conta WHERE id_correntista=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$id_correntista);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "ApiBancoDigital\Model\ContaModel");
    }

    public function numeroConta(){

        $pt1 = rand(10000000,99999999);
        $pt2 = rand(0,9);

        $num_conta = $pt1."-".$pt2;

        return $num_conta;

    }

    public function selectByNumeroConta(string $numero)
    {      
        $sql = "SELECT * FROM conta WHERE numero=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$numero);
        $stmt->execute();
        
        $obj = $stmt->fetchObject("ApiBancoDigital\Model\ContaModel");

        if (is_object($obj))
        {
            return $obj;
        }
        else return new ContaModel();

        
    }


}