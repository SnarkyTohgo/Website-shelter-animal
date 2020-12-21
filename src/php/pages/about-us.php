<?php
include_once("../includes/session.php");

?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <!-- Site Title-->
  <title>Sobre nós</title>
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
      <div class="brand-name"><img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
      </div>
      <div class="page-loader-body">
        <div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Page Header-->
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
                <li class="active"><a href="about-us.php">Sobre Nós</a></li>
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
      <div class="page-title-text">Sobre nós</div>
      <ul class="breadcrumbs-custom">
        <li><a href="../../index.php">Home</a></li>
        <li class="active">Sobre Nós</li>
      </ul>
    </div>

    <!-- Quem Somos-->
    <section class="section-md-top bg-gray-light text-center">
      <div class="shell">
        <h2>Quem somos</h2>
        <div class="range range-sm-center text-left">
          <div class="cell-sm-9 cell-md-6">
            <div class="section-md-bottom">
              <p class="h4-alternate">Ajudar milhares de animais sem casa</p>
              <p>
                Na Patinhas Felizes acreditamos que todos os animais merecem uma boa vida, respeito e carinho.
                O nosso objetivo é crescimento populacional zero através de programas de castração e serviços que focam na educação, cuidados médicos, acolhimento e adoção.
              </p>
              <ul class="list-bars">
                <li class="list-bars-item">
                  <!-- Progress Bar-->
                  <div class="progress-bar-bs progress-variant-primary">
                    <p class="list-bars-item-header">Cuidado animal</p>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                      </div>
                    </div><span class="caption">75%</span>
                  </div>
                </li>
                <li class="list-bars-item">
                  <!-- Progress Bar-->
                  <div class="progress-bar-bs progress-variant-primary">
                    <p class="list-bars-item-header">Acolhimento animal</p>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                      </div>
                    </div><span class="caption">85%</span>
                  </div>
                </li>
                <li class="list-bars-item">
                  <!-- Progress Bar-->
                  <div class="progress-bar-bs progress-variant-primary">
                    <p class="list-bars-item-header">Animais perdidos e achados</p>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      </div>
                    </div><span class="caption">80%</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="cell-sm-6 veil reveal-md-flex height-fill">
            <div class="image-wrap-2">
              <img src="../../images/about/about-1-570x481.png" alt="" width="570" height="481" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- O Que Fazemos-->
    <section class="section-decoration-wrap">
      <div class="shell">
        <div class="range">
          <div class="cell-md-6 cell-lg-5">
            <div class="section-decoration-image"><img src="../../images/about/about-2-946x628.jpg" alt="" width="946" height="628" />
            </div>
          </div>
          <div class="cell-md-6 cell-lg-7">
            <div class="section-decoration-content">
              <div class="section-lg">
                <h2>O Que Fazemos</h2>
                <p class="text-gray-darker">
                  Todos os anos centenas de animais como cães e gatos são abandonados por inúmeras razões.
                  A nossa missão é encontrar esses animais abandonados por todo o país e proporcionar-lhes uma vida melhor.
                  Tal como os humanos, eles precisam de amor, carinho e também uma casa. Nós criámos esta organização para lhes
                  dar uma oportunidade de terem uma casa e uma família que os ama. Os nossos sucessos estão a avançar e todos os
                  anos nós damos uma vida melhor a centenas de animais abandonados.
                </p>
                <a class="btn btn-primary btn-effect-anis" href="#">saiba mais</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Staff-->
    <section class="section-md bg-gray-light text-center">
      <div class="shell">
        <div class="range spacing-30">
          <div class="cell-xs-12">
            <h2>o nosso staff</h2>
            <p class="large">Uma equipa de profissionais de tratamento animal dedicada</p>
          </div>
          <div class="cell-xs-12">
            <div class="range spacing-30">
              <div class="cell-sm-6 cell-md-4">
                <a class="thumbnail-variant-1" href="#">
                  <img class="thumbnail-image" src="../../images/about/about-3-370x320.jpg" alt="" width="370" height="320" />
                  <div class="thumbnail-body">
                    <p class="thumbnail-title">Maria Madalena</p>
                    <p class="thumbnail-subtitle">Founder</p>
                    <p class="thumbnail-text">
                      A Maria é a fundadora da Patinhas Felizes. A sua paixão por salvar animais desenvolveu-se assim que
                      ela tomou conhecimento da quantidade de animais que necessitam de cuidados adequados.
                    </p>
                  </div>
                </a>
              </div>
              <div class="cell-sm-6 cell-md-4">
                <a class="thumbnail-variant-1 thumbnail-variant-1-blue-marguerite" href="#">
                  <img class="thumbnail-image" src="../../images/about/about-4-370x320.jpg" alt="" width="370" height="320" />
                  <div class="thumbnail-body">
                    <p class="thumbnail-title">John Doe</p>
                    <p class="thumbnail-subtitle">Financial Manager</p>
                    <p class="thumbnail-text">
                      O John supervisiona todas as doações e finanças das Patinhas Felizes. O seu trabalho permite-nos
                      focar-nos nos animais e nos seus cuidados.
                    </p>
                  </div>
                </a>
              </div>
              <div class="cell-sm-6 cell-md-4">
                <a class="thumbnail-variant-1 thumbnail-variant-1-tan-hide" href="#">
                  <img class="thumbnail-image" src="../../images/about/about-5-370x320.jpg" alt="" width="370" height="320" />
                  <div class="thumbnail-body">
                    <p class="thumbnail-title">Average Joana</p>
                    <p class="thumbnail-subtitle">Marketing Manager</p>
                    <p class="thumbnail-text">
                      A Joana é responsável por gerir as comunicações públicas da organização. Ela tem mais de dez anos de experiência
                      na área do marketing.
                    </p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Donate-->
    <section class="rd-parallax bg-gray-dark text-center bg-image" data-on="false" data-md-on="true" style="background-image: url(../../images/bg-image-2.jpg)">
      <div class="rd-parallax-layer" data-speed="0.5" data-type="media" data-url="../../images/about/bg-image-2.jpg"></div>
      <div class="rd-parallax-layer" data-speed="0" data-type="html">
        <div class="section-md">
          <div class="shell">
            <h3>Ajude as Patinhas Felizes a pôr um fim à crueldade animal</h3>
            <p class="big text-width-small">
              Você é a única esperança de milhares de gatos, cães e outros animais abandonados.
              Por favor considere fazer uma doação para nos ajudar a salvar mais vidas!
              You are the only hope of thousands of homeless cats, dogs, and other pets. Please consider making a donation today to help us save more lives!
            </p>
            <a class="btn btn-tan-hide btn-effect-anis" href="#">Façã uma doação</a>
          </div>
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
    <footer class="page-footer-default text-center">
      <div class="shell">
        <div class="range spacing-30">
          <div class="cell-md-6 cell-lg-8 text-md-left">
            <ul class="list-nav">
              <li><a href="../../index.php">Home</a></li>
              <li class="active"><a href="about-us.php">Sobre Nós</a></li>
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