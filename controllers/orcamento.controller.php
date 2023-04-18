<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/OrcamentoDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/orcamento.class.php");

class OrcamentoController
{
    public function criarOrcamento(Orcamento $orcamento)
    {
        $dao = new OrcamentoDAO();
        return $dao->inserirOrcamento($orcamento);
    }

    public function buscarTodos()
    {
        $dao = new OrcamentoDAO();
        return $dao->buscarTodos();
    }

    public function excluirOrcamento($id) {
        $dao = new OrcamentoDAO();
        return $dao->removeOrcamento($id);
    }
}
