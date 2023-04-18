<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/LoginDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/login.class.php");

$cliente = new Cliente();
$controller = new ClienteController();

if (isset($_POST) && isset($_POST['senhaAtual']) && !empty($_POST['senhaAtual'])) {
    
   
    $senha   = addslashes(filter_input(INPUT_POST, 'senhaAtual'));
    $senhaN = addslashes(filter_input(INPUT_POST, 'novaSenha'));

   

    $login = new Login();
    $logindao = new LoginDAO();

    $login -> setSenha($senhaN);
    $login ->setId($_SESSION['usuario_id']);
    $resultado= $logindao-> alterarSenha($login);


    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
} 

header('Location:../public/perfil.php');
