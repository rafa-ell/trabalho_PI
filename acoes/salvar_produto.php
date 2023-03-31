<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/produto.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/produto.controller.php");

$produto = new Produto();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $descricao   = addslashes(filter_input(INPUT_POST, 'descricao'));
    $codigobarras   = addslashes(filter_input(INPUT_POST, 'codigobarras'));
    $qtdeestoque         = addslashes(filter_input(INPUT_POST, 'qtdeestoque'));
    $ativo         = addslashes(filter_input(INPUT_POST, 'ativo'));

    // var_dump($cpfcnpj);

    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Obrigatório informar produto e descrição";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_produto.php?key=' . $id);
        die();
    }
    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setCodigoBarras($codigobarras);
    $produto->setEstoque($qtdeestoque);
    $produto->setAtivo($ativo);

    $controller = new ProdutoController();
    $resultado = $controller->atualizarProduto($produto);

    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
} else {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $codigobarras = isset($_POST['codigobarras']) ? $_POST['codigobarras'] : null;
    $qtdeestoque = isset($_POST['qtdeestoque']) ? $_POST['qtdeestoque'] : null;
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : null;

    if ($nome && $descricao) {

        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setCodigoBarras($codigobarras);
        $produto->setEstoque($qtdeestoque);
        $produto->setAtivo(true);


        $dao = new ProdutoController();
        $resultado = $dao->criarProduto($produto);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar o produto e a descrição";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
}
