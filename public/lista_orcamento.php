<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/controllers/orcamento.controller.php');

$controller = new OrcamentoController();
$orcamento = $controller->buscarTodos();

?>
<div class="container">
    <?php require_once('nav.php'); ?>

    <h1>Lista de Orçamentos</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Endereço</th>
                <th scope="col">Descrição</th>
                <th scope="col">Profissional</th>
                  
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orcamento as $orc) :
            ?>
                <tr>
                    <td><?= $orc->getId(); ?></td>
                    <td><?= $orc->getEndereco(); ?></td>
                    <td><?= $orc->getDescricao(); ?></td>
                    <td><?= $orc->getNomeprof() ?></td>

                    
                    <td>
                        <!-- <a class="btn btn-light" href="cad_pagamento.php?key=<?=$orc->getId()?>">Editar</a> -->
                        <a class="btn btn-link" href="../acoes/excluir_orcamento.php?key=<?=$orc->getId()?>">Excluir</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
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

</div>

<?php
require_once('./footer.php');
