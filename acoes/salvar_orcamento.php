<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/orcamento.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/orcamento.controller.php");

$orcamento = new Orcamento();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $endereco       = addslashes(filter_input(INPUT_POST, 'endereco'));
    $descricao    = addslashes(filter_input(INPUT_POST, 'descricao'));
    $id_prof    = addslashes(filter_input(INPUT_POST, 'id_prof'));

    if (empty($endereco) || empty($descricao)) {
        $_SESSION['mensagem'] = "Obrigatório informar endereço e descrição.";
        $_SESSION['sucesso'] = false;
        header('Location:../public/orcamento.php?key=' . $id);
        die();
    }


} else {
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $id_prof    = addslashes(filter_input(INPUT_POST, 'id_prof'));
    

    if ($endereco && $descricao) {
        
        $orcamento->setEndereco($endereco);
        $orcamento->setDescricao($descricao);
        $orcamento->setIdprof($id_prof);

        
        $dao = new OrcamentoController();
        $resultado = $dao->criarOrcamento($orcamento);
        if ($resultado) {
            $_SESSION['mensagem'] = "Orçamento solicitado com sucesso.";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao solicitar orçamento.";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar endereço e descrição.";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/orcamento.php?key=' . $id_prof);
}
