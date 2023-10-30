<?php

namespace PHPBancoDigital\Model;

use PHPBancoDigital\DAO\ContaDAO;

class ContaModel extends Model {
    public $id, $numero, $tipo, $saldo, $limite, $id_correntista;

    public $rows;

    public function save()
    {
        include 'DAO/ContaDAO.php';
        $dao = new ContaDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        } else {
            $dao->update($this);
        }
    }

    public function getAllRows()
    {
        include 'DAO/ContaDAO.php';
        $dao = new ContaDAO();

        $this->rows = $dao->select();

    }

    public function delete()
    {
        (new ContaDAO())->delete($this->id);
    }
    
    public function getById(int $id)
    {
        include 'DAO/ContaDAO.php';
        $dao = new ContaDAO();
        $obj = $dao->selectById($id);

        return($obj) ? $obj : new ContaModel();
    }

    public function getContaByIdCorrentista(int $id_correntista)
    {
            $dao = new ContaDAO();

            $this->rows = $dao->selectByIdCorrentista($id_correntista);
    }

    public function getContaByNumeroConta(string $numero)
    {
        return (new ContaDAO())->selectByNumeroConta($numero);
    }
  
}