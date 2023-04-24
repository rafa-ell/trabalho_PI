<?php
require_once('./header.php');
// require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/profissional.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/profissional.controller.php");

$profissional = new Profissional();

    $controller = new ProfissionalController();
    $profissional = $controller->BuscarProfissionalPorEmail($_SESSION['usuario_email']);

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
        <div class="mb-3">
            <label for="preco_hora" class="form-label">Preço por hora</label>
            <input type="number" min="0.00" step="0.01" class="form-control" id="preco_hora" name="preco_hora" value="<?= $profissional->getPreco_hora() ?>">
        </div>

        <label for="">Selecione a ategoria de serviço:</label>
        <br>
        <select name="servico" id="servico" style="width: 190px; height:30px; margin-bottom: 20px; margin-top: 10px;">
            <option value=""></option>
            <option value="servico_eletrico" <?= $profissional->getServico() == 'servico_eletrico' ? 'selected' : '' ?> >Serviços elétricos</option>
            <option value="servico_hidraulico" <?= $profissional->getServico() == 'servico_hidraulico' ? 'selected' : '' ?>>Serviços hidráulicos</option>
            <option value="ar_condicionado" <?= $profissional->getServico() == 'ar_condicionado' ? 'selected' : '' ?>>Ar-condicionado</option>
            <option value="pequenos_reparos" <?= $profissional->getServico() == 'pequenos_reparos' ? 'selected' : '' ?>>Pequenos reparos</option>
            <option value="fretes" <?= $profissional->getServico() == 'fretes' ? 'selected' : '' ?>>Fretes</option>
            <option value="instalacoes" <?= $profissional->getServico() == 'instalacoes' ? 'selected' : '' ?>>Instalações</option>
            <option value="pintura" <?= $profissional->getServico() == 'pintura' ? 'selected' : '' ?>>Pintura</option>
            <option value="decoracao" <?= $profissional->getServico() == 'decoracao' ? 'selected' : '' ?>>Decoração</option>
            <option value="servico_limpeza" <?= $profissional->getServico() == 'servico_limpeza' ? 'selected' : '' ?>>Serviços de limpeza</option>
            <option value="pedreiro" <?= $profissional->getServico() == 'pedreiro' ? 'selected' : '' ?>>Pedreiro</option>
            <option value="montador_moveis" <?= $profissional->getServico() == 'montador_moveis' ? 'selected' : '' ?>>Montador de móveis</option>
        </select>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $profissional->getEmail() ?>">
        </div>

        <?php
        if (empty($profissional -> getId())) {
            ?>

            <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" value="<?= $profissional->getSenha() ?>">
                    </div>
            <?php
        }
        ?>
        
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
