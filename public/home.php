<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/controllers/cliente.controller.php');

?>

<?php require_once('nav.php'); ?>


<div class="titulo">
      <h3 class="texto_p">Escolha uma categoria</h3>
    </div>
  </div>

  <div class="content">

    <ul>
      <li class="categoria">
        <a href="profissionais.php?servico=Eletricista">
          <div class="img">
            <img src="../assets/img/eletricista.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Serviços elétricos</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/hidraulico.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Serviços hidráulicos</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/ar.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Ar-condicionado</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/dedetizacao.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Dedetização</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/frete.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Fretes</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/image.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Reparos</h4>
          </div>
        </a>
      </li>

      <li class="categoria">
        <a href="">
          <div class="img">
            <img src="../assets/img/pintura.jpg" alt="">
          </div>

          <!-- <hr style="margin: 0px;"> -->

          <div class="desc">
            <h4>Pintor</h4>
          </div>
        </a>
      </li>

    </ul>


    <!-- <div class="servicos">
      <img src="../img/plumber.png" alt="">
    </div>
    <div class="servicos">
        <img src="../img/plumber2.png" alt="">
    </div>
    <div class="servicos">
        <a href=""><img src="../img/mechanic.png" alt=""></a>
    </div>
    <div class="servicos">
        <img src="../img/cleaning-staff.png" alt="">
    </div>
    <div class="servicos">
        
    </div>
    <div class="servicos">
        
    </div> -->

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
