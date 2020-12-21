<?php
include_once('../includes/database.php');
include_once('../includes/session.php');
include_once('../db/db_breed.php');
include_once('../db/db_type.php');
include_once('../db/db_pet.php');


// Pets
if (isset($_GET['pageNo'])) {
    $pageNo = $_GET['pageNo'];
} else {
    $pageNo = 1;
}

if (isset($_GET['type'])) {
    $rawType = $_GET['type'];
    $type = getTypeId($rawType);
} else {
    $type = 'null';
}

if (isset($_GET['breed'])) {
    $rawBreed = $_GET['breed'];
    $breed = getBreedId($rawBreed);
} else {
    $breed = 'null';
}

if (isset($_GET['gender'])) {
    $gender = $_GET['gender'];
} else {
    $gender = 'null';
}

if (isset($_GET['age'])) {
    $age = $_GET['age'];
} else {
    $age = 'null';
}

$resultsTotalPages = getResultsTotalPages($type, $breed, $gender, $age);
$results = getSearchresults($type, $breed, $gender, $age, $pageNo);

?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Resultados</title>
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
            <div class="page-title-text">Animais Encontrados</div>
            <ul class="breadcrumbs-custom">
                <li><a href="../../index.php">Home</a></li>
                <li class="active">Animais Encontrados</li>
            </ul>
        </div>

        <!-- Adotar animais-->
        <section class="section-md bg-white text-center">
            <div class="shell">
                <!-- Tabs-->
                <div class="tabs tabs-custom tabs-vertical tabs-corporate tabs-wide" id="tabs-1" data-url-tabs="true">
                    <!-- Tab panes-->
                    <div class="tab-content">
                        <!-- Tab 1-->
                        <div class="tab-pane fade in active" id="adopt-cats">
                            <div class="range spacing-30">
                                <?php if (sizeof($results) == 0) : ?>
                                    <div class="cell-xs-2 center-content">
                                        <p>Sem resultados</p>
                                    </div>
                                <?php endif; ?>
                                <?php foreach ($results as $row) : ?>
                                    <div class="cell-xs-12">
                                        <!-- Thumbnail boxed horizontal-->
                                        <div class="thumbnail-boxed thumbnail-boxed-horizontal">
                                            <div class="thumbnail-boxed-left">
                                                <img class="thumbnail-boxed-image" src="../../images/adopt/<?= $row['image'] ?>" alt="" width="370" height="254" />
                                            </div>
                                            <div class="thumbnail-boxed-body">
                                                <p class="thumbnail-boxed-title">
                                                    <a href="pet.php?idPet=<?= $row['idPet']; ?>">
                                                        <?= $row['name'] ?>
                                                    </a>
                                                </p>
                                                <div class="thumbnail-boxed-text">
                                                    <p><?= mb_strimwidth($row['description'], 0, 150, '...') ?></p>
                                                </div>
                                                <div class="thumbnail-boxed-footer">
                                                    <ul class="thumbnail-boxed-meta">
                                                        <li><span class="icon icon-xs icon-tan-hide material-icons-event_available"></span><span><?= $row['age'] ?> anos</span></li>
                                                        <li><span class="icon icon-xs icon-tan-hide material-icons-done"></span><span><?= $row['weight'] ?> kg</span></li>
                                                        <li><span class="icon icon-xs icon-tan-hide material-icons-place"></span><span><?= $row['location'] ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- Tab Navigation-->
                            <?php if (sizeof($results) != 0) : ?>
                                <ul id="profile-cats-pagination" class="pagination-custom">
                                    <li class="<?= $pageNo == 1 ? 'disabled' : ''; ?>"><a href="search-results.php?pageNo=<?= $pageNo - 1; ?>&type=<?= $rawType ?>&breed=<?= $rawBreed ?>&gender=<?= $gender ?>&age=<?= $age ?>" aria-label="Previous"></a></li>
                                    <?php for ($i = 1; $i <= $resultsTotalPages; $i++) : ?>
                                        <li class="<?= $i == $pageNo ? 'active' : ''; ?>"><a href="search-results.php?pageNo=<?= $i; ?>&type=<?= $rawType ?>&breed=<?= $rawBreed ?>&gender=<?= $gender ?>&age=<?= $age ?>"><?= $i; ?></a></li>
                                    <?php endfor; ?>
                                    <li class="<?= $pageNo == $resultsTotalPages ? 'disabled' : ''; ?>"><a href="search-results.php?pageNo=<?= $pageNo + 1; ?>&type=<?= $rawType ?>&breed=<?= $breed ?>&gender=<?= $gender ?>&age=<?= $age ?>" aria-label="Next"></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
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
        <!-- footer-->
        <footer class="page-footer-default text-center">
            <div class="shell">
                <div class="range spacing-30">
                    <div class="cell-md-6 cell-lg-8 text-md-left">
                        <ul class="list-nav">
                            <li><a href="../../index.php">Home</a></li>
                            <li><a href="about-us.php">Sobre Nós</a></li>
                            <li class="active"><a href="adopt-a-pet.php">Adote um Animal</a></li>
                            <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
                        </ul>
                    </div>
                    <div class="cell-md-8 cell-lg-4 text-md-right">
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