<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
?>

<div class="container">
    <?php require_once('nav.php'); ?>

    <h4>Alteração de Senha</h4>

    <p>Sua senha precisa conter no mínimo 6 caracteres.</p>
    <p>Sua senha precisa conter letras e números.</p>
    <p>Sua senha precisa conter uma letra maiúscula.</p>

    <form>
        <div class="mb-3">
            <!-- <label for="senhaAtual" class="form-label"></label> -->
            <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Senha Atual">
        </div>
        <div class="mb-3">
            <!-- <label for="formGroupExampleInput2" class="form-label">Another label</label> -->
            <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Nova Senha">
        </div>
        <div class="mb-3">
            <!-- <label for="formGroupExampleInput2" class="form-label">Another label</label> -->
            <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Confirmar Senha">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Senha</button>
    </form>

    <div class="terms">
        <a href="">Ajuda</a>
        <a href="">Termos de Uso</a>
    </div>

</div>