<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./home.php">Home</a>
        <div class="logo">
    <a href="home.php"><img class="img_logo" src="../assets/img/logo-design.png" alt=""></a>
  </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profissionais.php">Profissionais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./perfil.php">Perfil</a>
                </li>
                <li>
                    <a class="nav-link active" href="logoff.php">Sair</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">
                        <?= isset($_SESSION) && isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : ''; ?>
                    </a>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>


