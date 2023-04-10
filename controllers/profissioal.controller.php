<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/ProfissionalDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");

class ProfissionalController
{

    public function buscarTodos()
    {
        $dao = new ProfissionalDAO();
        return $dao->buscarTodos();
    }

    public function buscarPorId($id)
    {
        $dao = new ProfissionalDAO();
        return $dao->buscarUm($id);
    }

    public function cadastrarProfissional(Profissional $profissional)
    {
        $dao = new profissionalDAO();
        return $dao->inserirProduto($profissional);
    }

    public function atualizarProduto(Profissional $profissional) {
        $dao = new ProfissionalDAO();
        return $dao->atualizaProfissional($profissional);
    }

    public function excluirProfissional($id) {
        $dao = new ProfissionalDAO();
        return $dao->excluirProfissional($id);
    }
    
}