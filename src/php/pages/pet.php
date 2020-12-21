<?php
include_once('../includes/session.php');
include_once('../db/db_pet.php');
include_once('../db/db_breed.php');

$signedin = false;
if (isset($_SESSION['email'])) {
  $signedin = true;
}

$idPet = $_GET['idPet'];
$pet = getPet($idPet);
$breed = getBreed($pet['idBreed']);

?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <!-- Site Title-->
  <title><?= $pet['name']; ?></title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">

  <!-- Stylesheets-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/animations.css">
</head>

<body>
  <!-- Page-->
  <div class="page">
    <!-- Page Loader-->
    <div class="page-loader">
      <div class="brand-name">
        <img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
      </div>
      <div class="page-loader-body">
        <div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>
      </div>
    </div>
    <header class="page-header">
      <!-- Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-default" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-stick-up-clone="true" data-md-stick-up-offset="190px" data-lg-stick-up-offset="190px">
          <div class="rd-navbar-top-panel">
            <div class="rd-navbar-top-panel-toggle" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span></div>
            <div class="rd-navbar-top-panel-content">
              <ul class="inline-list-xxs">
                <li><a class="icon icon-xxs icon-circle icon-gray-outline icon-effect-1 fa fa-instagram" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-gray-outline icon-effect-1 fa fa-facebook" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-gray-outline icon-effect-1 fa fa-twitter" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-gray-outline icon-effect-1 fa fa-google-plus" href="#"></a></li>
              </ul>
            </div>
          </div>
          <div class="rd-navbar-inner">
            <!-- Navbar Panel-->
            <div class="rd-navbar-panel">
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
              <!-- Navbar Brand-->
              <div class="rd-navbar-brand">
                <a class="brand-name" href="../../index.php">
                  <img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
                </a>
              </div>
            </div>
            <!-- Navbar Nav-->
            <div class="rd-navbar-nav-wrap">
              <ul class="rd-navbar-nav">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="about-us.php">Sobre Nós</a></li>
                <li><a href="adopt-a-pet.php">Adotar</a></li>
                <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Breadcrumbs & Page title-->
    <div class="page-title">
      <div class="page-title-text"><?= $pet['name']; ?></div>
      <ul class="breadcrumbs-custom">
        <li><a href="../../index.php">Home</a></li>
        <li class="active"><?= $pet['name']; ?></li>
      </ul>
    </div>

    <!-- Pet page-->
    <section class="section-md bg-white text-center">
      <div class="shell">
        <div class="range range-sm-center">
          <div class="cell-sm-8 cell-md-12">
            <!-- Box profile-->
            <article class="box-profile">
              <div class="box-profile-left">
                <img class="box-profile-image" src="../../images/adopt/<?= $pet['image']; ?>" alt="" width="570" height="389" />
              </div>
              <div class="box-profile-body">
                <p class="box-profile-name"><?= $pet['name']; ?></p>
                <p class="box-profile-description"><?= $breed; ?> - <?= $pet['gender'] == 1 ? 'Fêmea' : 'Macho'; ?></p>
                <div class="box-profile-text">
                  <p><?= $pet['description']; ?></p>
                  <p class="box-profile-title">Informação para Adoção</p>
                  <p>
                    Todos os animais foram verificados por um veterinário, castrados e estão a par das vacinações.
                    Os custos de adoção incluem transportadora, postes para arranhar, e um kit de comida e areia mais um brinquedo.
                    Oferecemos conselho gratuíto acerca do seu animal em qualquer altura. Se, por algum motivo não resultar nós ficamos
                    com o animal de volta em qualquer altura.
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
        <?php if (isset($_SESSION['email'])) : ?>
        <div class="range range-sm-left">
          <div class="cell-sm-11 cell-md-3">
            <!-- Favourite-->
            <form id="favourite-form" class="rd-mailform form-label-centered" method="post" action="../actions/action_favourite.php?csrf=<?= $_SESSION['csrf'] ?>">
              <input type="text" name="pet-id" value="<?= $pet['idPet'] ?>" style="display: none">
              <input type="text" name="csrf" value="<?= $_SESSION['csrf'] ?>" style="display: none">
              <button id="favourite-btn" class="btn btn-icon btn-icon-left btn-primary" type="submit">
                <span class="icon icon-md material-icons-favorite"></span>
                Favorito
              </button>
            </form>
          </div>
          <div class="cell-sm-1 cell-md-1">
            <div id="success"><i class="fas fa-check"></i></div>
            <!-- ajax loader-->
            <div id="favourite-loader" class="loadingio-spinner-spin-jcwopzzxjlr" style="display: none;">
              <div class="ldio-fwhocskhhxn">
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
                <div>
                  <div></div>
                </div>
              </div>
            </div>
            <!-- end ajax loader-->
          </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['email'])) : ?>
          <div class="range range-sm-center">
            <div class="cell-sm-12 cell-md-8">
              <!-- Pedir para Adoção-->
              <h4>Pedir para Adoção</h4>

              <div class="form-group" style="margin-top: 20px;">
                <input type="checkbox" id="ask-for-adoption">
                <label for="ask-for-adoption"> Pedir para adotar</label>
              </div>

              <form id="ask-for-adoption-form" class="rd-mailform form-label-centered" style="margin-top: 20px; display: none;">
                <div class="cell-sm-12">
                  <div class="form-group">
                    <input type="text" name="csrf" value="<?= $_SESSION['csrf']; ?>" style="display: none">
                    <input type="text" name="receiver-id" value="<?= $pet['idUser']; ?>" style="display: none">
                    <input type="text" name="pet-id" value="<?= $pet['idPet']; ?>" style="display: none">

                    <textarea class="form-control" id="adopt-message" type="text" name="message"></textarea>
                    <label class="form-label" for="adopt-message">Mensagem</label>
                  </div>
                </div>
                <div class="cell-sm-11">
                  <button id="ask-for-adoption-btn" class="btn btn-tan-hide btn-block" type="submit">Enviar</button>
                </div>
                <div class="cell-sm-1">
                  <div id="success"><i class="fas fa-check"></i></div>
                  <!-- ajax loader-->
                  <div id="ask-for-adoption-loader" class="loadingio-spinner-spin-jcwopzzxjlr" style="display: none;">
                    <div class="ldio-fwhocskhhxn">
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                    </div>
                  </div>
                  <!-- end ajax loader-->
                </div>
              </form>

              <form id="send-message-form" class="rd-mailform form-label-centered" style="margin-top: 20px;">
                <div class="cell-sm-12">
                  <div class="form-group">
                    <input type="text" name="csrf" value="<?= $_SESSION['csrf']; ?>" style="display: none">
                    <input type="text" name="receiver-id" value="<?= $pet['idUser']; ?>" style="display: none">

                    <textarea class="form-control" id="message" type="text" name="msg"></textarea>
                    <label class="form-label" for="message">Mensagem</label>
                  </div>
                </div>
                <div class="cell-sm-11">
                  <button id="send-message-btn" class="btn btn-tan-hide btn-block" type="submit">Enviar</button>
                </div>
                <div class="cell-sm-1">
                  <div id="success"><i class="fas fa-check"></i></div>
                  <!-- ajax loader-->
                  <div id="send-message-loader" class="loadingio-spinner-spin-jcwopzzxjlr" style="display: none;">
                    <div class="ldio-fwhocskhhxn">
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                      <div>
                        <div></div>
                      </div>
                    </div>
                  </div>
                  <!-- end ajax loader-->
                </div>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- Page Footer-->
    <section class="pre-footer-default text-center text-sm-left">
      <div class="shell">
        <div class="range range-sm-center spacing-55">
          <div class="cell-sm-6 cell-md-4">
            <div class="brand-sm">
              <a href="../../index.php">
                <img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
              </a>
            </div>
            <p>
              Como organização líder de bem-estar animal na área, a Patinhas Felizes está a transformar a forma de como
              as pessoas pensam sobre os animais e tratam deles por todo Portugal.
            </p>
            <div class="group-sm group-middle"><span class="big text-blue-marguerite">Redes sociais</span>
              <ul class="inline-list-xxs">
                <li><a class="icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-instagram" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-facebook" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-twitter" href="#"></a></li>
                <li><a class="icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-google-plus" href="#"></a></li>
              </ul>
            </div>
          </div>
          <div class="cell-sm-6 cell-md-4"></div>
          <div class="cell-sm-6 cell-md-4"></div>
        </div>
      </div>
    </section>
    <!-- footer-->
    <footer class="page-footer-default text-center">
      <div class="shell">
        <div class="range spacing-30">
          <div class="cell-md-6 cell-lg-8 text-md-left">
            <ul class="list-nav">
              <li><a href="../../index.php">Home</a></li>
              <li><a href="about-us.php">Sobre Nós</a></li>
              <li><a href="adopt-a-pet.php">Adote um Animal</a></li>
              <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
            </ul>
          </div>
          <div class="cell-md-6 cell-lg-4 text-md-right">
            <p class="rights">Patinhas Felizes&nbsp;&copy;&nbsp;<span id="copyright-year"></span>.&nbsp;<br class="veil-sm"><a class="link-underline" href="privacy-policy.php">Política de Privacidade</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Javascript-->
  <script src="../../js/core.min.js"></script>
  <script src="../../js/script.js"></script>
  <script src="../../js/rest-api.js"></script>

</html>