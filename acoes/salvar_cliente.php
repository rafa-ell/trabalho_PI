<?php
session_start();

// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/LoginDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/login.class.php");

$cliente = new Cliente();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $cpfcnpj    = addslashes(filter_input(INPUT_POST, 'cpfcnpj'));
    $telefone   = addslashes(filter_input(INPUT_POST, 'telefone'));
    $email   = addslashes(filter_input(INPUT_POST, 'email'));
    
    var_dump($cpfcnpj);

    if (empty($nome) || empty($cpfcnpj)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CPF/CNPJ";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_cliente.php?key=' . $id);
        die();
    }


    $cliente->setId($id);
    $cliente->setNome($nome);
    $cliente->setCpfCnpj($cpfcnpj);
    $cliente->setTelefone($telefone);
    $cliente->setEmail($email);
    

    $controller = new ClienteController();
    $resultado = $controller->atualizarCliente($cliente);

    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
} else {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $cpfcnpj    = addslashes(filter_input(INPUT_POST, 'cpfcnpj'));
    $telefone   = addslashes(filter_input(INPUT_POST, 'telefone'));
    $email   = addslashes(filter_input(INPUT_POST, 'email'));
    $senha   = addslashes(filter_input(INPUT_POST, 'senha'));

    if (empty($nome) || empty($cpfcnpj)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CPF/CNPJ";
        $_SESSION['sucesso'] = false;
        // header('Location:../public/cad_cliente.php?key=' . $id);
        // echo 'rwerew';
        die();
    }

    $cliente->setNome($nome);
    $cliente->setCpfCnpj($cpfcnpj);
    $cliente->setTelefone($telefone);
    $cliente->setEmail($email);
    $cliente->setSenha($senha);

    $dao = new ClienteController();
    $resultado = $dao->criarCliente($cliente);
    if ($resultado) {
        $login = new Login();
        $login->setEmail($email);
        $login->setSenha($senha);
        $login->setAtivo(true);
        $login->setTipo("user");
        $dao = new LoginDAO();
        $dao->inserirLogin($login);
        $_SESSION['mensagem'] = "Criado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao criar";
        $_SESSION['sucesso'] = false;
    }
}
header('Location:../public/cad_cliente.php');
