<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/controllers/profissional.controller.php');

$controller = new ProfissionalController();
$profissionais = $controller->buscarTodos();

?>
<div class="container">
    <?php require_once('nav.php'); ?>

    <h1>Lista de Profissionais</h1>
    <a class="btn btn-primary" href="cad_profissional.php">Novo Profissional</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Serviço</th>
                <th scope="col">Preço/Hora</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($profissionais as $c) :
            ?>
                <tr>
                    <td><?= $c->getId(); ?></td>
                    <td><?= $c->getNome(); ?></td>
                    <td><?= $c->getCnpj(); ?></td>
                    <td><?= $c->getTelefone(); ?></td>
                    <td><?= $c->getServico(); ?></td>
                    <td><?= $c->getPreco_hora(); ?></td>
                    <td>
                        <a class="btn btn-light" href="cad_profissional.php?key=<?=$c->getId()?>">Editar</a>
                        <a class="btn btn-link" href="../acoes/excluir_profissional.php?key=<?=$c->getId()?>">Excluir</a>
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