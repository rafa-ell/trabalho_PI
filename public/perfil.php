<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/perfil.controller.php');

?>

<div class="container">
    <?php require_once('nav.php'); ?>


    <div class="user">
        <a href="">Usuário</a>
        <a href="./cad_cliente.php">Editar Perfil</a>
    </div>
    <div class="botoes">
        <a class="btn btn-primary" href=".php">Pedidos</a>
        
        <?php
        if (isset($_SESSION) && isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'user') {
        ?>
            <a class="btn btn-primary" href="./pagamentos.php">Meios de Pagamento</a>
        <?php
        }
        ?>
        
        <a class="btn btn-primary" href=".php">Favoritos</a>
        <a class="btn btn-primary" href="./senha.php">Alterar Senha</a>
    </div>

    <div class="terms">
        <a href="">Ajuda</a>
        <a href="">Termos de Uso</a>
    </div>

</div>