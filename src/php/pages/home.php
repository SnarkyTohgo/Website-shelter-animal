<?php
include_once('../includes/session.php');
include_once('../includes/database.php');
include_once('../db/db_type.php');
include_once('../db/db_breed.php');
include_once('../db/db_pet.php');

$loggedIn = false;

if (isset($_SESSION['email']))
    $loggedIn = true;


// Breeds
$allBreeds = getAllBreeds();
$catBreeds = getCatBreeds();
$dogBreeds = getDogBreeds();
$smallAnimalBreeds = getSmallAnimalBreeds();

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Home</title>

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <!-- Stylesheets-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/animations.css">

    <style>
        #home-select-dog-breeds,
        #home-select-cat-breeds,
        #home-select-small-animal-breeds {
            display: none;
        }
    </style>

    <script>
        <?php if (isset($_GET['search-failed'])) : ?>
            alert("A pesquisa falhou!\nPor favor selecione todos os campos");
        <?php endif; ?>
    </script>
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
                <nav class="rd-navbar rd-navbar-top-panel-light" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-fullwidth" data-stick-up-clone="true" data-md-stick-up-offset="90px" data-lg-stick-up-offset="90px">
                    <div class="rd-navbar-inner">
                        <!-- Navbar Nav-->
                        <div class="rd-navbar-nav-wrap">
                            <ul class="rd-navbar-nav">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about-us.php">Sobre Nós</a></li>
                                <li><a href="adopt-a-pet.php">Adotar</a></li>
                                <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
                            </ul>
                        </div>
                        <!-- Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                            <!-- Navbar Brand-->
                            <div class="rd-navbar-brand">
                                <a class="brand-name" href="index.php">
                                    <img src="../../images/logo-default-176x45.png" alt="" width="176" height="45" />
                                </a>
                            </div>
                        </div>
                        <!-- Navbar Top Panel-->
                        <div class="rd-navbar-top-panel">
                            <div class="rd-navbar-top-panel-toggle" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span></div>
                            <div class="rd-navbar-top-panel-content">
                                <ul class="inline-list-xxs">
                                    <li><a class="icon icon-xxs icon-circle icon-gray-filled fa fa-instagram" href="#"></a></li>
                                    <li><a class="icon icon-xxs icon-circle icon-gray-filled fa fa-facebook" href="#"></a></li>
                                    <li><a class="icon icon-xxs icon-circle icon-gray-filled fa fa-twitter" href="#"></a></li>
                                    <li><a class="icon icon-xxs icon-circle icon-gray-filled fa fa-google-plus" href="#"></a></li>
                                </ul>
                                <?php
                                if ($loggedIn)
                                    echo '<a class="btn btn-sm btn-primary-outline btn-effect-ujarak" href="user-profile.php">Meu Perfil</a>';
                                else
                                    echo '<a class="btn btn-sm btn-primary-outline btn-effect-ujarak" href="login.php">Login</a>';
                                ?>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- Swiper-->
        <section>
            <div class="swiper-bg-wrap swiper-style-2 bg-white">
                <div class="swiper-container swiper-slider swiper-bg" data-autoplay="3500" data-direction="vertical">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-slide-bg="../../images/home/slider-2-slide-1-1920x850.jpg"></div>
                        <div class="swiper-slide" data-slide-bg="../../images/home/slider-2-slide-2-1920x850.jpg"></div>
                        <div class="swiper-slide" data-slide-bg="../../images/home/slider-2-slide-3-1920x850.jpg"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-bg-content">
                    <div class="jumbotron-custom jumbotron-custom-variant-2">
                        <div class="shell">
                            <div class="jumbotron-custom-inner">
                                <p class="h1 wow fadeIn" data-wow-duration=".7s">patudinhos felizes</p>
                                <p class="h4 mark mark-alternate wow fadeInUpSmall" data-wow-delay=".1s" data-wow-duration=".7s"> adote um animal, faça um novo amigo</p>
                                <blockquote class="quote-preview wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration=".7s">
                                    <p>
                                        <q>Salve uma vida e apaixone-se por um novo companheiro fiel. Introduza um novo membro na sua família.</q>
                                    </p>
                                </blockquote>
                                <a class="btn btn-blue-marguerite btn-effect-ujarak wow fadeInUpSmall" href="adopt-a-pet.php" data-wow-delay=".3s" data-wow-duration=".4s">
                                    Adote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm bg-white bg-decorated">
            <div class="bg-decoration bg-decoration-top">
                <svg version="1.0" xmlns="https://www.w3.org/2000/svg" width="1919.000000px" height="24.000000px" viewbox="0 0 1919.000000 24.000000" preserveaspectratio="none">
                    <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)" stroke="none">
                        <path d="M8725 224 c-515 -17 -1068 -50 -1682 -99 -887 -70 -1083 -80 -1418          -71 -239 5 -446 25 -840 81 -263 36 -346 45 -555 56 -332 19 -567 3 -1200 -79          -537 -69 -850 -77 -1395 -32 -325 26 -613 26 -1090 0 -598 -33 -545 -28 -545          -56 l0 -24 9595 0 9595 0 0 24 c0 29 24 26 -430 52 -491 28 -865 30 -1180 4          -552 -44 -867 -37 -1400 32 -631 82 -866 98 -1198 79 -211 -11 -294 -20 -557          -56 -394 -56 -601 -76 -840 -81 -336 -9 -493 -1 -1480 76 -1071 83 -1280 91          -2360 94 -511 2 -970 2 -1020 0z"></path>
                    </g>
                </svg>
            </div>
            <div class="shell">
                <div class="range range-sm-center range-md-right range-md-reverse">
                    <div class="cell-md-7">
                        <div class="box-form box-form-2">
                            <!-- Mailform-->
                            <form class="rd-mailform form-style-classic" method="post" action="../actions/action_search.php">
                                <div class="range range-xs-center range-sm-bottom spacing-30">
                                    <div class="cell-xs-10 cell-sm-6">
                                        <div class="form-group custom-select">
                                            <label class="form-label-outside" for="pet-type">Tipo de animal</label>
                                            <select class="form-control select-filter" id="pet-type" name="search-type">
                                                <option value="null">Todos</option>
                                                <option value="cao">Cão</option>
                                                <option value="gato">Gato</option>
                                                <option value="pequeno">Pequeno porte</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="home-select-breeds" class="cell-xs-10 cell-sm-6">
                                        <div id="home-select-all-breeds" class="form-group custom-select">
                                            <label class="form-label-outside" for="form-breed-all">Raça</label>
                                            <select id="form-breed-all" class="form-control select-filter" name="search-breed-all">
                                                <option value="null">Todas</option>
                                                <?php
                                                foreach ($allBreeds as $row) {
                                                    foreach ($row as $key => $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div id="home-select-cat-breeds" class="form-group custom-select">
                                            <label class="form-label-outside" for="form-breed-cats">Raça</label>
                                            <select id="form-breed-cats" class="form-control select-filter" name="search-breed-cats">
                                                <option value="null">Todas</option>
                                                <?php
                                                foreach ($catBreeds as $row) {
                                                    foreach ($row as $key => $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div id="home-select-dog-breeds" class="form-group custom-select">
                                            <label class="form-label-outside" for="form-breed-dogs">Raça</label>
                                            <select id="form-breed-dogs" class="form-control select-filter" name="search-breed-dogs">
                                                <option value="null">Todas</option>
                                                <?php
                                                foreach ($dogBreeds as $row) {
                                                    foreach ($row as $key => $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div id="home-select-small-animal-breeds" class="form-group custom-select">
                                            <label class="form-label-outside" for="form-breed-small">Raça</label>
                                            <select id="form-breed-small" class="form-control select-filter" name="search-breed-small">
                                                <option value="null">Todas</option>
                                                <?php
                                                foreach ($smallAnimalBreeds as $row) {
                                                    foreach ($row as $key => $value) {
                                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="cell-xs-10 cell-sm-6">
                                        <div class="form-group custom-select">
                                            <label class="form-label-outside" for="form-sex">Sexo</label>
                                            <select class="form-control select-filter" id="form-sex" name="search-gender">
                                                <option value="null">Todos</option>
                                                <option value="0">Macho</option>
                                                <option value="1">Fêmea</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="cell-xs-10 cell-sm-6">
                                        <div class="form-group custom-select">
                                            <label class="form-label-outside" for="age-group">Faixa etária</label>
                                            <select class="form-control select-filter" id="age-group" name="search-age">
                                                <option value="null">Todas</option>
                                                <option value="1">0-5 anos</option>
                                                <option value="2">5+ anos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="cell-xs-10 cell-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary btn-effect-anis" type="submit">Encontrar Patudinhos</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="cell-sm-6 cell-md-5 veil reveal-md-block">
                        <figure class="image-wrap-3">
                            <img src="../../images/home/home2-1-533x482.png" alt="" width="533" height="482" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <!-- Thumbnails-->
        <section class="section-xl bg-white">
            <div class="shell">
                <div class="range range-sm-center">
                    <div class="cell-sm-11 cell-md-12">
                        <div class="range spacing-30">
                            <div class="cell-xs-6 cell-md-3">
                                <!-- Thumbnail ruby-->
                                <a class="thumbnail-ruby" href="adopt-a-pet.php#adopt-dogs">
                                    <img class="thumbnail-ruby-image" src="../../images/home/home2-2-269x408.jpg" alt="" width="269" height="408" />
                                    <div class="thumbnail-ruby-caption">
                                        <p class="thumbnail-ruby-title">
                                            <span data-letters-l="Cã" data-letters-r="es">Cães</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="cell-xs-6 cell-md-3">
                                <!-- Thumbnail ruby-->
                                <a class="thumbnail-ruby" href="adopt-a-pet.php#adopt-small-pets">
                                    <img class="thumbnail-ruby-image" src="../../images/home/home2-3-269x408.jpg" alt="" width="269" height="408" />
                                    <div class="thumbnail-ruby-caption">
                                        <p class="thumbnail-ruby-title">
                                            <span data-letters-l="Páss" data-letters-r="aros">Pássaros</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="cell-xs-6 cell-md-3">
                                <!-- Thumbnail ruby-->
                                <a class="thumbnail-ruby" href="adopt-a-pet.php#adopt-a-cat">
                                    <img class="thumbnail-ruby-image" src="../../images/home/home2-4-269x408.jpg" alt="" width="269" height="408" />
                                    <div class="thumbnail-ruby-caption">
                                        <p class="thumbnail-ruby-title">
                                            <span data-letters-l="Ga" data-letters-r="tos">Gatos</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="cell-xs-6 cell-md-3">
                                <!-- Thumbnail ruby-->
                                <a class="thumbnail-ruby" href="adopt-a-pet.php#adopt-small-pets">
                                    <img class="thumbnail-ruby-image" src="../../images/home/home2-5-269x408.jpg" alt="" width="269" height="408" />
                                    <div class="thumbnail-ruby-caption">
                                        <p class="thumbnail-ruby-title">
                                            <span data-letters-l="Coe" data-letters-r="lhos">Coelhos</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="cell-xs-12">
                                <!-- Box cta-->
                                <article class="box-cta box-cta-1">
                                    <div class="box-cta-body">
                                        <p class="box-cta-title">mais de <?= getTotalPets(); ?></p>
                                        <div class="box-cta-subtitle">
                                            <div class="box-cta-subtitle-top"><span>Adoráveis</span></div>
                                            <div class="box-cta-subtitle-bottom"><span>animais</span></div>
                                        </div>
                                    </div>
                                    <div class="box-cta-control">
                                        <a class="btn btn-xl btn-block btn-blue-marguerite-alternate btn-effect-anis" href="adopt-a-pet.php">ver todos os animais</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us-->
        <section class="section-xl section-xl-mod bg-white">
            <div class="shell shell-fluid shell-condensed">
                <div class="range range-condensed">
                    <div class="cell-xs-12 cell-xl-4 cell-xl-push-2 height-fill block-top-level">
                        <div class="box-tabs">
                            <h2>Sobre Nós</h2>
                            <!-- Bootstrap tabs-->
                            <div class="tabs-custom tabs-horizontal tabs-line tabs-centered" id="tabs-1">
                                <!-- Nav tabs-->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tabs-1-1" data-toggle="tab">a nossa missão</a></li>
                                    <li><a href="#tabs-1-2" data-toggle="tab">O nosso objetivo</a></li>
                                    <li><a href="#tabs-1-3" data-toggle="tab">A NOSSA VISÃO</a></li>
                                </ul>
                                <!-- Tab panes-->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tabs-1-1">
                                        <p>
                                            Todos os anos centenas de animais como cães e gatos são abandonados por inúmeras razões.
                                            A nossa missão é encontrar esses animais abandonados por todo o país e proporcionar-lhes uma vida melhor.
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-1-2">
                                        <p>
                                            O nosso objetivo é fazer com que a associação Patinhas Felizes seja o primeiro lugar onde potenciais famílias venham procurar um novo animal para adoção,
                                            assegurando assim que todos os animais sejam bem tratados e encontrem uma nova casa.
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-1-3">
                                        <p>
                                            Nós envisionamos a Patinhas Felizes como uma sociedade onde animais de companhia são todos valorizados e tratados com respeito,
                                            e garantidamente encontrem uma casa e uma família que os acolham.
                                        </p>
                                    </div>
                                </div>
                            </div><a class="btn btn-primary btn-effect-anis" href="about-us.php">saiba mais</a>
                        </div>
                    </div>

                    <div class="cell-md-6 cell-xl-4 height-fill">
                        <div class="range range-custom-bordered range-custom-bordered-mod bg-blue-marguerite bg-aside-left">
                            <div class="cell-xs-6 height-fill">
                                <div class="counter-box-bold">
                                    <div class="counter">1</div>
                                    <p class="counter-box-header">Anos de Abrigo Animal</p>
                                </div>
                            </div>
                            <div class="cell-xs-6 height-fill">
                                <div class="counter-box-bold">
                                    <div class="counter"><?= getAdoptedPets(); ?></div>
                                    <p class="counter-box-header">Animais Adotados</p>
                                </div>
                            </div>
                            <div class="cell-xs-6 height-fill">
                                <div class="counter-box-bold">
                                    <div class="counter">26</div>
                                    <p class="counter-box-header">Voluntários</p>
                                </div>
                            </div>
                            <div class="cell-xs-6 height-fill">
                                <div class="counter-box-bold">
                                    <div class="counter"><?= getTotalPets(); ?></div>
                                    <p class="counter-box-header">Animais ao nosso cuidado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell-md-6 cell-xl-4 cell-xl-push-3 height-fill veil reveal-md-flex">
                        <div class="image-wrap-4">
                            <img src="../../images/home/home1-5-922x657.jpg" alt="" width="922" height="657" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- A wide range of affordable pet care services-->
        <section class="rd-parallax bg-gray-dark text-center bg-image" data-on="false" data-md-on="true" style="background-image: url(../../images/home/bg-image-10.jpg)">
            <div class="rd-parallax-layer" data-speed="0.5" data-type="media" data-url="../../images/home/bg-image-10.jpg">
            </div>
            <div class="rd-parallax-layer" data-speed="0" data-type="html">

                <div class="section-md">
                    <div class="shell">
                        <div class="complex-text complex-text-xs-centered">
                            <p class="h1 complex-text-main">HISTÓRIAS DE</p>
                            <div class="complex-text-aside">
                                <p class="h2">SUCESSO</p>
                                <h4 class="header-lighter">Acerca dos Animais Adotados</h4>
                            </div>
                        </div>
                        <!-- Owl Carousel-->
                        <div class="owl-style-1">
                            <div class="owl-carousel" data-items="1" data-stage-padding="15" data-loop="true" data-margin="30" data-mouse-drag="false" data-nav="true" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut">

                                <div class="item">
                                    <!-- Quote circle-->
                                    <blockquote class="quote-circle">
                                        <div class="unit unit-xs-horizontal">
                                            <div class="unit-left">
                                                <div class="quote-circle-image">
                                                    <img src="../../images/home/home1-6-280x320.jpg" alt="" width="280" height="320" />
                                                </div>
                                            </div>
                                            <div class="unit-body">
                                                <div class="quote-circle-body">
                                                    <div class="quote-circle-header">
                                                        <cite>Luísa Ferreira Gomes</cite><small>e a Maia</small>
                                                    </div>
                                                    <p class="quote-circle-text">
                                                        <q>Quando eu vi a foto dela no site, eu sabia que ela tinha encontrado a casa dela. Ela é tão fofinha e carinhosa e demos-lhe o nome de "Maia".</q>
                                                    </p>
                                                    <div class="quote-circle-meta">
                                                        <ul class="quote-circle-meta-list">
                                                            <li><span>11/10/2020</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <div class="item">
                                    <!-- Quote circle-->
                                    <blockquote class="quote-circle">
                                        <div class="unit unit-xs-horizontal">
                                            <div class="unit-left">
                                                <div class="quote-circle-image"><img src="../../images/home/home1-7-280x320.jpg" alt="" width="280" height="320" />
                                                </div>
                                            </div>
                                            <div class="unit-body">
                                                <div class="quote-circle-body">
                                                    <div class="quote-circle-header">
                                                        <cite>Matilde Martins Pinto</cite><small>e a Cookie</small>
                                                    </div>
                                                    <p class="quote-circle-text">
                                                        <q>Depois de adotar a Cookie este ano a minha vida mudou por completo. Eu genuinamente aprecio o que vocês fizeram por ela, e fico feliz que ela nos tenha encontrado.</q>
                                                    </p>
                                                    <div class="quote-circle-meta">
                                                        <ul class="quote-circle-meta-list">
                                                            <li><span>21/3/2020</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <div class="item">
                                    <!-- Quote circle-->
                                    <blockquote class="quote-circle">
                                        <div class="unit unit-xs-horizontal">
                                            <div class="unit-left">
                                                <div class="quote-circle-image"><img src="../../images/home/home1-8-280x320.jpg" alt="" width="280" height="320" />
                                                </div>
                                            </div>
                                            <div class="unit-body">
                                                <div class="quote-circle-body">
                                                    <div class="quote-circle-header">
                                                        <cite>Joana Monteiro</cite><small>e o D'Artacão</small>
                                                    </div>
                                                    <p class="quote-circle-text">
                                                        <q>O D'Artacão é um dos cães mais energéticos e alegres que já tive! Obrigado, Patinhas Felizes, por tornarem a minha vida mais positiva e feliz!</q>
                                                    </p>
                                                    <div class="quote-circle-meta">
                                                        <ul class="quote-circle-meta-list">
                                                            <li><span>16/6/2020</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section decorator -->
        <section class="section-md bg-white bg-decorated">
            <div class="bg-decoration bg-decoration-bottom">
                <svg version="1.0" xmlns="https://www.w3.org/2000/svg" width="1918.000000px" height="26.000000px" viewbox="0 0 1918.000000 26.000000" preserveaspectratio="none">
                    <g transform="translate(0.000000,26.000000) scale(0.100000,-0.100000)" stroke="none">
                        <path d="M0 144 l0 -117 48 7 c26 3 196 9 377 12 287 5 362 3 575 -15 332 -29          631 -37 811 -22 79 7 333 37 563 67 552 72 755 84 1017 61 107 -10 221 -22          254 -28 33 -5 87 -14 120 -19 33 -5 89 -14 125 -20 276 -46 393 -59 595 -66          209 -7 421 3 670 32 143 17 218 26 685 87 925 120 1519 142 2685 101 302 -10          717 -17 1080 -17 363 0 778 7 1080 17 1165 41 1767 19 2685 -101 675 -88 777          -100 990 -114 98 -7 246 -9 365 -5 201 7 317 19 595 66 36 6 92 15 125 20 33          5 87 14 120 19 33 6 147 18 254 28 262 23 465 11 1017 -61 230 -30 484 -60          563 -67 180 -15 479 -7 811 22 214 18 287 20 580 15 184 -3 347 -9 363 -12          l27 -6 0 116 0 116 -9590 0 -9590 0 0 -116z"></path>
                    </g>
                </svg>
            </div>
        </section>

        <!-- Google Map-->
        <section>
            <div id="map"></div>
        </section>

        <!-- Page Footer-->
        <section class="pre-footer-minimal bg-gray-dark bg-decorated">
            <div class="bg-decoration bg-decoration-top">
                <svg version="1.0" xmlns="https://www.w3.org/2000/svg" width="1919.000000px" height="24.000000px" viewbox="0 0 1919.000000 24.000000" preserveaspectratio="none">
                    <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)" stroke="none">
                        <path d="M8725 224 c-515 -17 -1068 -50 -1682 -99 -887 -70 -1083 -80 -1418          -71 -239 5 -446 25 -840 81 -263 36 -346 45 -555 56 -332 19 -567 3 -1200 -79          -537 -69 -850 -77 -1395 -32 -325 26 -613 26 -1090 0 -598 -33 -545 -28 -545          -56 l0 -24 9595 0 9595 0 0 24 c0 29 24 26 -430 52 -491 28 -865 30 -1180 4          -552 -44 -867 -37 -1400 32 -631 82 -866 98 -1198 79 -211 -11 -294 -20 -557          -56 -394 -56 -601 -76 -840 -81 -336 -9 -493 -1 -1480 76 -1071 83 -1280 91          -2360 94 -511 2 -970 2 -1020 0z"></path>
                    </g>
                </svg>
            </div>
            <div class="pre-footer-minimal-inner">
                <div class="shell text-center text-sm-left">
                    <div class="range range-sm-center spacing-55">
                        <div class="cell-sm-12 cell-md-4 text-sm-center text-md-left">
                            <h4>Links</h4>
                            <div class="group-md-1">
                                <ul class="list-nav-marked">
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="about-us.php">Sobre nós</a></li>
                                </ul>
                                <ul class="list-nav-marked">
                                    <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
                                    <li><a href="adopt-a-pet.php">Adote um Animal</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="cell-sm-4 cell-md-3">
                            <h4>Horário</h4>
                            <dl class="terms-list-inline">
                                <dt>Segunda a Sexta</dt>
                                <dd>08h00–19h30</dd>
                            </dl>
                            <dl class="terms-list-inline">
                                <dt>Sábado, Domingo</dt>
                                <dd>08h00–16h00</dd>
                            </dl>
                        </div>
                        <div class="cell-sm-4 cell-md-2">
                            <h4>Telefone</h4>
                            <ul class="list-xxs">
                                <li><a class="link link-md" href="callto:#">912345678</a></li>
                                <li><a class="link" href="mailto:#">geral@patinhasfelizes.pt</a></li>
                            </ul>
                        </div>
                        <div class="cell-sm-4 cell-md-3">
                            <h4>Morada</h4>
                            <address class="reveal-inline-block" style="max-width: 215px">
                                <p>R. Dr. Roberto Frias, 4200-465 Porto</p>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shell">
                <hr>
            </div>
        </section>
        <footer class="page-footer-minimal">
            <div class="shell">
                <p class="rights">Patinhas Felizes&nbsp;&copy;&nbsp;<span id="copyright-year"></span>.&nbsp;
                    <br class="veil-sm">
                    <a class="link-underline" href="#">Política de Privacidade</a>
                </p>
            </div>
        </footer>
    </div>

    <!-- Javascript-->
    <script src="../../js/core.min.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/rest-api.js"></script>
    <script>
        /**
         * Google Maps
         * @description Enables google maps javascript API
         */
        function initMap() {
            const coords = {
                lat: 41.178526,
                lng: -8.595832
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: coords,
                zoom: 15,
            });

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(41.178526, -8.595832),
                title: "Patinhas Felizes",
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_swMrfdmlTKq1Fo3oKDmO89jvcqqNfNs&callback=initMap&libraries=&v=weekly" async defer></script>

</html>