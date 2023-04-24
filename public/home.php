<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/cliente.controller.php');

?>

<?php require_once('nav.php'); ?>


<div class="content">
  <div class="titulo">
    <h3 class="texto_p">Encontre profissionais por categoria</h3>
  </div>

  <ul>
    <li class="categoria">
      <a href="profissionais.php?servico=servico_eletrico">
        <div class="img">
          <img src="../assets/img/lamp.png" alt="">
        </div>

        <div class="desc">
          <h4>Serviços elétricos</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=servico_hidraulico">
        <div class="img">
          <img src="../assets/img/tap.png" alt="">
        </div>

        <div class="desc">
          <h4>Serviços hidráulicos</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=ar_condicionado">
        <div class="img">
          <img src="../assets/img/ar-condicionado.png" alt="">
        </div>

        <div class="desc">
          <h4>Ar-condicionado</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=pequenos_raparos">
        <div class="img">
          <img src="../assets/img/screw-driver.png" alt="">
        </div>

        <div class="desc">
          <h4>Pequenos reparos</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=fretes">
        <div class="img">
          <img src="../assets/img/truck.png" alt="">
        </div>

        <div class="desc">
          <h4>Fretes</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=intalacoes">
        <div class="img">
          <img src="../assets/img/furadeira.png" alt="">
        </div>

        <div class="desc">
          <h4>Instalações</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=pintura">
        <div class="img">
          <img src="../assets/img/paint-roller.png" alt="">
        </div>

        <div class="desc">
          <h4>Pintura</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=decoracao">
        <div class="img">
          <img src="../assets/img/house-decoration.png" alt="">
        </div>

        <div class="desc">
          <h4>Decoração</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=limpeza">
        <div class="img">
          <img src="../assets/img/cleaning.png" alt="">
        </div>

        <div class="desc">
          <h4>Limpeza</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=pedreiro">
        <div class="img">
          <img src="../assets/img/brickwall.png" alt="">
        </div>

        <div class="desc">
          <h4>Pedreiro</h4>
        </div>
      </a>
    </li>

    <li class="categoria">
      <a href="profissionais.php?servico=montador_moveis">
        <div class="img">
          <img src="../assets/img/gabinete.png" alt="">
        </div>

        <div class="desc">
          <h4>Montador de móveis</h4>
        </div>
      </a>
    </li>

  </ul>

  <div class="app_conteudo">
    <div>
      <h2 style="text-align: center;">Baixe o aplicativo</h2>
    </div>
    <div class="app">
      <a href="" target=""><img src="../assets/img/playstore.webp" alt=""></a>
      <a href=""><img src="../assets/img/appstore.webp" alt=""></a>
    </div>
    <div class="img_phone">
      <img src="../assets/img/smartphone.png" alt="">
    </div>
  </div>

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
</div>
<?php

require_once('./footer.php');
