<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/profissional.controller.php");

$profissional = new Profissional();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ProfissionalController();
    $profissional = $controller->buscarPorId($id);
}

?>

<div class="container">
    <?php require_once('nav.php'); ?>
    <h1>Cadastro de proffionais </h1>

    <form method="POST" action="../acoes/salvar_profissional.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Profissional</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $profissional->getNome() ?>">
            <input type="hidden" name="id" value="<?= $profissional->getId(); ?>">
        </div>
        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="number" class="form-control" id="cnpj" name="cnpj" value="<?= $profissional->getCnpj() ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="number" class="form-control" id="telefone" name="telefone" value="<?= $profissional->getTelefone() ?>">
        </div>
        <div class="mb-3">
            <label for="servico" class="form-label">Serviço</label>
            <input type="text" class="form-control" id="servico" name="servico" value="<?= $profissional->getServico() ?>">
        </div>
        <div class="mb-3">
            <label for="ativo" class="form-label">Preço/Hora</label>
            <input type="number" class="form-control" id="ativo" name="ativo" value="<?= $profissional->getPreco_hora() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
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

</div>

<?php
require_once('./footer.php');
