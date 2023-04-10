<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/ProfissionalDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");

class ProfissionalController
{

    // public function buscarTodos()
    // {
    //     $dao = new ClienteDAO();
    //     return $dao->buscarTodos();
    // }

    // public function buscarPorId($id)
    // {
    //     $dao = new ClienteDAO();
    //     return $dao->buscarUm($id);
    // }

    public function criarProfissional(Profissional $profissional)
    {
        $dao = new ProfissionalDAO();
        return $dao->inserirProfissional($profissional);
    }

    // public function atualizarCliente(Cliente $cliente) {
    //     $dao = new ClienteDAO();
    //     return $dao->atualizaCliente($cliente);
    // }

    // public function excluirCliente($id) {
    //     $dao = new ClienteDAO();
    //     return $dao->removeCliente($id);
    // }
}
