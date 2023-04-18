<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/PerfilDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/perfil.class.php");

class PerfilController
{

    public function buscarTodos()
    {
        $dao = new PerfilDAO();
        return $dao->buscarTodos();
    }

    public function buscarPorId($id)
    {
        $dao = new PerfilDAO();
        return $dao->buscarUm($id);
    }

    public function criarPerfil(Perfil $perfil)
    {
        $dao = new PerfilDAO();
        return $dao->inserirPerfil($perfil);
    }

    public function atualizarPerfil(Perfil $perfil) {
        $dao = new PerfilDAO();
        return $dao->atualizaPerfil($perfil);
    }

    public function excluirPerfil($id) {
        $dao = new PerfilDAO();
        return $dao->removePerfil($id);
    }
    
}