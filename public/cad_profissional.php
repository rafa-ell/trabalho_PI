<?php
require_once('./header.php');
// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/profissional.controller.php");

$profissional = new Profissional();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ProfissionalController();
    // $cliente = $controller->buscarPorId($id);
}

?>

<?php require_once('nav.php'); ?>

<div class="container">
    
    
    <h1>Criar cadastro </h1>

    <form method="POST" action="../acoes/salvar_profissional.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $profissional->getNome() ?>">
            <input type="hidden" name="id" value="<?= $profissional->getId(); ?>">
        </div>
        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?= $profissional->getCnpj() ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?= $profissional->getTelefone() ?>">
        </div>
        <!-- <div class="mb-3">
            <label for="servico" class="form-label">Serviço</label>
            <input type="text" class="form-control" id="servico" name="servico" value="<?= $profissional->getServico() ?>">
        </div> -->
        <div class="mb-3">
            <label for="precohora" class="form-label">Preço por hora</label>
            <input type="number" min="0.00" step="0.01" class="form-control" id="precohora" name="precohora" value="<?= $profissional->getPrecoHora() ?>">
        </div>

        <label for="">Categoria de serviço:</label>
        <br>
        <select name="" id="" form="" style="width: 190px; margin-bottom: 20px; margin-top: 20px;">
            <option value=""></option>
            <option value="">Elétrico</option>
            <option value="">Hidráulico</option>
            <option value="">Ar-condicionado</option>
            <option value="">Dedetização</option>
            <option value="">Fretes</option>
            <option value="">Reparos</option>
            <option value="">Pintura</option>
        </select>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $profissional->getEmail() ?>">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" value="<?= $profissional->getSenha() ?>">
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
