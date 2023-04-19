<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/orcamento.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/orcamento.controller.php");


$orcamento = new Orcamento();

 if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new OrcamentoController();
    // $cliente = $controller->buscarPorId($id);
}
?>



<?php require_once('nav.php'); ?>

<div class="container">

    <h1>Solicitar orçamento</h1>

    <form method="POST" action="../acoes/salvar_orcamento.php">
      
    <!-- <label for="">Categoria de serviço:</label>
        <br> -->
        <!-- <select name="" id="" form="" style="width: 190px; margin-bottom: 20px; margin-top: 20px;">
            <option value=""></option>
            <option value="">Elétrico</option>
            <option value="">Hidráulico</option>
            <option value="">Ar-condicionado</option>
            <option value="">Dedetização</option>
            <option value="">Fretes</option>
            <option value="">Reparos</option>
            <option value="">Pintura</option>
        </select> -->
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?= $orcamento->getEndereco() ?>">
            <input type="hidden" name="id" value="<?= $orcamento->getId(); ?>">
        </div>
        
        <div>
            <label for="descricao">Descrição do serviço a ser solicitado:</label>
            <textarea type="text" name="descricao" id="descricao" cols="30" rows="10" value="<?= $orcamento->getDescricao() ?>"></textarea>
        </div>
        <!-- <div>
            <label>Anexar imagens: <input type="file" name="image"></label>
            <input type="submit" value="Submit">
        </div> -->
        <button type="submit" class="btn btn-primary">Solicitar orçamento</button>

        <a class="btn btn-primary" href="lista_orcamento.php">Orçamentos</a>
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
