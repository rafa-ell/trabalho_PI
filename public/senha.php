<?php

require_once('./header.php');

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");


$cliente = new Cliente();

if (isset($_SESSION) && isset($_SESSION['usuario_id'])) {
    $id = $_SESSION['usuario_id'];
    $controller = new ClienteController();
    $cliente = $controller->buscarPorId($id);
}

?>

<?php require_once('nav.php'); ?>
<div class="container">
    

    <h4>Alteração de Senha</h4>

    <p>Sua senha precisa conter no mínimo 6 caracteres.</p>
    <p>Sua senha precisa conter letras e números.</p>
    <p>Sua senha precisa conter uma letra maiúscula.</p>

    <form method="POST" action="../acoes/salvar_senha.php">
        <div class="mb-3">
            <!-- <label for="senhaAtual" class="form-label"></label> -->
            <input type="password" class="form-control" id="senha" name="senhaAtual" placeholder="Senha Atual">
        </div>
        <div class="mb-3">
            <!-- <label for="formGroupExampleInput2" class="form-label">Another label</label> -->
            <input type="password" class="form-control" id="senha" name="novaSenha" placeholder="Nova Senha">
        </div>
        <div class="mb-3">
            <!-- <label for="formGroupExampleInput2" class="form-label">Another label</label> -->
            <input type="password" class="form-control" id="senha" name="confirmaSenha"  placeholder="Confirmar Senha">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Senha</button>
    </form>
    
    <?php
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == TRUE) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    unset($_SESSION['sucesso'], $_SESSION['mensagem']);
    ?>
    <div class="terms">
        <a href="">Ajuda</a>
        <a href="">Termos de Uso</a>
    </div>

</div>

<?php

require_once('./footer.php');