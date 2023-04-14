<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/profissional.controller.php');

$servico = null;

if (
    isset($_GET['servico'])  && !empty($_GET['servico'])
) {
    $servico = filter_input(INPUT_GET, 'servico');
}


$controller = new ProfissionalController();
if ($servico == null) {

    $profissional = $controller->buscarTodos();
} else {
    $profissional = $controller->buscarServico($servico);
}


// teste

?>

<?php require_once('nav.php'); ?>

<div class="container">
   

    <h1>Lista de Profissionais</h1>
    <!-- <a class="btn btn-primary" href="cad_servico.php">Novo Profissional</a> -->
    <table class="table table-striped">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Serviço</th>
                <th scope="col">R$ hora</th>

                <!-- <th scope="col">Ações</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            // var_dump($profissional);
            foreach ($profissional as $prof) :
            ?>
                <tr>
                    <!-- <td><?= $prof->getId(); ?></td> -->
                    <td><?= $prof->getNome(); ?></td>
                    <td><?= $prof->getTelefone(); ?></td>
                    <td><?= $prof->getServico(); ?></td>
                    <td><?= $prof->getPrecoHora(); ?></td>

                    <td>
                        <a class="btn btn-light" href="orcamento.php?key=<?= $prof->getId() ?>">Contratar</a>
                        <!-- <a class="btn btn-link" href="../acoes/excluir_profissional.php?key=<?= $prof->getId() ?>">Excluir</a> -->
                    </td>
                    <!-- <td>
                        <a class="btn btn-light" href="cad_profissional.php?key=<?= $prof->getId() ?>">Editar</a>
                        <a class="btn btn-link" href="../acoes/excluir_profissional.php?key=<?= $prof->getId() ?>">Excluir</a>
                    </td>  -->
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
