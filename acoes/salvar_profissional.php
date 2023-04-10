<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/profissional.controller.php");

$produto = new Profissional();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $cnpj   = addslashes(filter_input(INPUT_POST, 'cnpj'));
    $telefone   = addslashes(filter_input(INPUT_POST, 'telefone'));
    $servico         = addslashes(filter_input(INPUT_POST, 'servico'));
    $preco_hora         = addslashes(filter_input(INPUT_POST, 'preco_hora'));

    // var_dump($cnpj);

    if (empty($nome) || empty($cnpj)) {
        $_SESSION['mensagem'] = "Obrigatório informar nome e cnpj";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_profissional.php?key=' . $id);
        die();
    }
    $profissional->setId($id);
    $profissional->setNome($nome);
    $profissional->setCnpj($cnpj);
    $profissional->setTelefone($telefone);
    $profissional->setServico($servico);
    $profissional->setPreco_hora($preco_hora);

    $controller = new ProfissionalController();
    $resultado = $controller->atualizarProfissional($profissional);

    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_profissional.php');
} else {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $cnpj = isset($_POST['cnpjo']) ? $_POST['cnpj'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $servico = isset($_POST['servico']) ? $_POST['servico'] : null;
    $preco_hora = isset($_POST['preco_hora']) ? $_POST['preco_hora'] : null;

    if ($nome && $cnpj) {

        $profissional->setNome($nome);
        $profissional->setCnpj($cnpj);
        $profissional->setTelefone($telefone);
        $profissional->setServico($servico);
        $profissional->setPreco_hora($preco_hora);


        $dao = new ProfissionalController();
        $resultado = $dao->cadastrarProfissional($profissional);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar o nome e o cnpj";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_profissional.php');
}