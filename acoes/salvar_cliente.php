<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/LoginDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/login.class.php");

$cliente = new Cliente();

if (isset($_POST) && isset($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $cpfcnpj    = addslashes(filter_input(INPUT_POST, 'cpfcnpj'));
    $telefone   = addslashes(filter_input(INPUT_POST, 'telefone'));
    $email   = addslashes(filter_input(INPUT_POST, 'email'));
    $senha   = addslashes(filter_input(INPUT_POST, 'senha'));
    var_dump($cpfcnpj);

    if (empty($nome) || empty($cpfcnpj)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CPF/CNPJ";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_cliente.php?key=' . $id);
        die();
    }


    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $cpfcnpj = isset($_POST['cpfcnpj']) ? $_POST['cpfcnpj'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if ($nome && $cpfcnpj) {

        $cliente->setNome($nome);
        $cliente->setCpfCnpj($cpfcnpj);
        $cliente->setTelefone($telefone);
        $cliente->setEmail($email);
        $cliente->setSenha($senha);

        $dao = new ClienteController();
        $resultado = $dao->criarCliente($cliente);
        if ($resultado) {
            $login= new Login();
            $login->setEmail($email);
            $login->setSenha($senha);
            $login->setAtivo(true);
            $login->setTipo("user");
            $dao = new LoginDAO();
            $dao-> inserirLogin($login);
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CPF/CNPJ";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_cliente.php');
    // $cliente->setId($id);
    // $cliente->setNome($nome);
    // $cliente->setCpfCnpj($cpfcnpj);
    // $cliente->setTelefone($telefone);
    // $cliente->setEmail($email);
    // $cliente->setSenha($senha);

    // $controller = new ClienteController();
    // $resultado = $controller->atualizarCliente($cliente);

    // if ($resultado) {
    //     $_SESSION['mensagem'] = "Atualizado com sucesso";
    //     $_SESSION['sucesso'] = true;
    // } else {
    //     $_SESSION['mensagem'] = "Erro ao atualizar";
    //     $_SESSION['sucesso'] = false;
    // }
    // header('Location:../public/cad_cliente.php');
} 
