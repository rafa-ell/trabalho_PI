<?php
session_start();

// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/profissional.controller.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/LoginDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/login.class.php");

$profissional = new Profissional();

var_dump($_POST);

if (isset($_POST) && isset($_POST['id']) && empty($_POST['id'])) {

echo 'teste';

    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $cnpj    = addslashes(filter_input(INPUT_POST, 'cnpj'));
    $telefone   = addslashes(filter_input(INPUT_POST, 'telefone'));
    $servico   = addslashes(filter_input(INPUT_POST, 'servico'));
    $preco_hora   = addslashes(filter_input(INPUT_POST, 'preco_hora'));
    $email   = addslashes(filter_input(INPUT_POST, 'email'));
    $senha   = addslashes(filter_input(INPUT_POST, 'senha'));


    if (empty($nome) || empty($cnpj)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CNPJ";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_profissional.php?key=' . $id);
        die();
    }


    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $servico = isset($_POST['servico']) ? $_POST['servico'] : null;
    $preco_hora = isset($_POST['preco_hora']) ? $_POST['preco_hora'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;



    if ($nome && $cnpj) {

        $profissional->setNome($nome);
        $profissional->setCnpj($cnpj);
        $profissional->setTelefone($telefone);
        $profissional->setServico($servico);
        $profissional->setPreco_Hora($preco_hora);
        $profissional->setEmail($email);
        $profissional->setSenha($senha);

        $dao = new ProfissionalController();
        $resultado = $dao->criarProfissional($profissional);
        if ($resultado) {
            $login = new Login();
            $login->setEmail($email);
            $login->setSenha($senha);
            $login->setAtivo(true);
            $login->setTipo("prof");
            $dao = new LoginDAO();
            $dao->inserirLogin($login);
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CNPJ";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_profissional.php');
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
