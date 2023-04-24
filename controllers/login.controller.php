<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/DAO/LoginDAO.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/login.class.php');

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        $_SESSION['mensagem'] = "O email e senha devem ser preenchidas";
        header("Location:../public/index.php");
        return 0;
    }

    $dao = new LoginDAO();
    $login = new Login();
    $login = $dao->buscaUsuarioPorEmail($email);


    if ($login && $senha == $login->getSenha() && $login->getAtivo() == true) {
        $_SESSION['usuario_email'] = $login->getEmail();
        $_SESSION['usuario_id'] = $login->getId();
        $_SESSION['tipo_usuario'] = $login->getTipo();
        if ($login->getTipo() == "prof") {
            header("Location:../public/lista_orcamento.php");
        } else {
            header("Location:../public/home.php");
        }
    } else if ($login && $login->getAtivo() == false) {
        $_SESSION['mensagem'] = "Usuário está inativo.";
        header("Location:../public/index.php");
    } else {
        $_SESSION['mensagem'] = "Email e/ou senha incorretos.";
        header("Location:../public/index.php");
    }
}
