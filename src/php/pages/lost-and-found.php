<?php
include_once('../includes/session.php');
include_once('../db/db_pet.php');

$animals = getLostAndFound();

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <!-- Site Title-->
  <title>Perdios e Achados</title>
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
      <!-- RD Navbar-->
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
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand">
                <a class="brand-name" href="../../index.php">
                  <img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
                </a>
              </div>
            </div>
            <!-- RD Navbar Nav-->
            <div class="rd-navbar-nav-wrap">
              <ul class="rd-navbar-nav">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="about-us.php">Sobre Nós</a></li>
                <li><a href="adopt-a-pet.php">Adotar</a></li>
                <li class="active"><a href="lost-and-found.php">Perdidos e Achados</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Breadcrumbs & Page title-->
    <div class="page-title">
      <div class="page-title-text">Perdidos e Achados</div>
      <ul class="breadcrumbs-custom">
        <li><a href="../../index.php">Home</a></li>
        <li class="active">Perdidos e Achados</li>
      </ul>
    </div>

    <!-- Gallery-->
    <section class="section-md bg-white text-center">
      <div class="shell isotope-wrap">
        <h2>Galeria</h2>
        <ul class="isotope-filters-responsive">
          <li>
            <p>Escolha a categoria:</p>
          </li>
          <li class="block-top-level">
            <!-- Isotope Filters-->
            <button class="isotope-filters-toggle btn btn-sm btn-primary" data-custom-toggle="#isotope-1" data-custom-toggle-hide-on-blur="true">Filter<span class="caret"></span></button>
            <div class="isotope-filters" id="isotope-1">
              <ul class="inline-list">
                <li><a class="active" data-isotope-filter="*" data-isotope-group="gallery" href="#">Todos</a></li>
                <li><a data-isotope-filter="gato" data-isotope-group="gallery" href="#">gatos</a></li>
                <li><a data-isotope-filter="cao" data-isotope-group="gallery" href="#">cães</a></li>
                <li><a data-isotope-filter="pequeno" data-isotope-group="gallery" href="#">animais de pequeno porte</a></li>
              </ul>
            </div>
          </li>
        </ul>
        <!-- Isotope Content-->
        <div class="row isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-photo-swipe-gallery="gallery">
          <?php foreach ($animals as $row) : ?>
            <div class="col-xs-12 col-sm-6 col-md-4 isotope-item" data-filter="<?= $row['name']; ?>">
              <a class=" thumbnail-classic" href="mailto:<?= $row['email']; ?>">
                <figure class="box-lost-and-found">
                  <img src="../../images/lost-and-found/<?= $row['image']; ?>" alt="" width="370" height="320" />
                </figure>
                <div class="caption">
                  <p class="caption-title"><?= $row['title']; ?></p>
                  <p class="caption-text"><?= $row['location']; ?></p>
                  <p class="caption-text"><?= $row['contact']; ?></p>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
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
              <li class="active"><a href="lost-and-found.php">Perdidos e Achados</a></li>
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