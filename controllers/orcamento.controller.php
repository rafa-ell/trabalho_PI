<?php


require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/OrcamentoDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/orcamento.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/ClienteDAO.php");

class OrcamentoController
{
    public function criarOrcamento(Orcamento $orcamento)
    {
        $clienteDao = new ClienteDAO();
        $cliente = $clienteDao->buscarPorEmail($_SESSION['usuario_email']);
        $orcamento->setIdCliente($cliente->getId());
        $dao = new OrcamentoDAO();
        return $dao->inserirOrcamento($orcamento);
    }

    public function buscarTodos()
    {
        $clienteDao = new ClienteDAO();
        $cliente = $clienteDao->buscarPorEmail($_SESSION['usuario_email']);
        $dao = new OrcamentoDAO();
        return $dao->buscarTodos($cliente->getId());
    }

    public function excluirOrcamento($id) {
        $dao = new OrcamentoDAO();
        return $dao->removeOrcamento($id);
    }
}
