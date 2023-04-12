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
        <a class="btn btn-primary" href="./pagamentos.php">Meios de Pagamento</a>
        <a class="btn btn-primary" href=".php">Favoritos</a>
        <a class="btn btn-primary" href=".php">Alterar Senha</a>
    </div>

</div>