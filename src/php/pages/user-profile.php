<?php
include_once('../includes/database.php');
include_once('../includes/session.php');
include_once('../db/db_user.php');
include_once('../db/db_pet.php');
include_once('../db/db_type.php');
include_once('../db/db_breed.php');
include_once('../db/db_favourite.php');
include_once('../db/db_message.php');
include_once('../db/db_adopt.php');

if (!isset($_SESSION['email']))
    die(header('Location: login.php'));

// Breeds
$allBreeds = getAllBreeds();
$catBreeds = getCatBreeds();
$dogBreeds = getDogBreeds();
$smallAnimalBreeds = getSmallAnimalBreeds();

// Pets
if (isset($_GET['pageNo'])) {
    $pageNo = $_GET['pageNo'];
} else {
    $pageNo = 1;
}

$dogsTotalPages = getUserDogsTotalPages($_SESSION['email']);
$catsTotalPages = getUserCatsTotalPages($_SESSION['email']);

$dogs = getUserDogs($_SESSION['email'], $pageNo);
$cats = getUserCats($_SESSION['email'], $pageNo);
$smallAnimals = getUserSmallAnimals($_SESSION['email']);

// User
$user = getUser($_SESSION['email']);

// Favourites
$favourites = getFavourites($_SESSION['email']);

// Messages 
$messages = getMessages($_SESSION['email']);

// Adoption Requests
$adoptionRequests = getAdoptionRequests();

?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Perfil de Utilizador</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <!-- Stylesheets-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/animations.css">

    <!-- Page Styles-->
    <style>
        #profile-banner {
            background-image: url(../../images/users/<?= $user['coverImg'] ?>);
        }

        #profile-select-dog-breeds,
        #profile-select-cat-breeds,
        #profile-select-small-animal-breeds {
            display: none;
        }

        .thumbnail-classic .caption:before {
            position: relative;
            content: '\f0c1';
            display: block;
            z-index: 1;
            margin-bottom: 10px;
            font: 400 40px "FontAwesome";
            line-height: 1;
            transition: .33s all ease;
            color: #fff;
        }
    </style>
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
                            <form id="login-form" class="rd-mailform" style="left: 100%;" method="post" action="../actions/action_logout.php">
                                <button class="btn btn-sm btn-primary-outline btn-effect-ujarak">Logout</button>
                            </form>
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
        <div id="profile-banner" class="page-title">
            <div class="page-title-text">Perfil do Utilizador</div>
            <ul class="breadcrumbs-custom">
                <li><a href="../../index.php">Home</a></li>
                <li class="active">Perfil do Utilizador</li>
            </ul>
        </div>


        <section class="section-md bg-white text-center">
            <div class="shell">
                <div class="range range-sm-center spacing-30">
                    <div class="cell-sm-10">
                        <h3>Painel</h3>
                        <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                            <!-- Nav tabs-->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabs-1-1" data-toggle="tab">Informações de Perfil</a></li>
                                <li><a href="#tabs-1-2" data-toggle="tab">Colocar para adoção</a></li>
                                <li><a href="#tabs-1-3" data-toggle="tab">Editar Perfil</a></li>
                                <li><a href="#tabs-1-4" data-toggle="tab">Mensagens</a></li>
                                <li><a href="#tabs-1-5" data-toggle="tab">Pedidos de Adoção</a></li>
                                <li><a href="#tabs-1-6" data-toggle="tab">Perdidos e Achados</a></li>
                            </ul>
                            <!-- Tab panes-->
                            <div class="tab-content">
                                <!-- Tab 1 - Informações de Perfil-->
                                <div class="tab-pane fade in active" id="tabs-1-1">
                                    <div class="range spacing-55">
                                        <div class="cell-xs-6 cell-md-4">
                                            <article class="box-minimal">
                                                <div class="box-minimal-icon fa fa-user"></div>
                                                <div class="box-minimal-title">Nome</div>
                                                <div class="box-minimal-divider"></div>
                                                <div id="user-name" class="box-minimal-text"><?= $user['firstName'] . " " . $user['lastName'] ?></div>
                                            </article>
                                        </div>
                                        <div class="cell-xs-6 cell-md-4">
                                            <article class="box-minimal">
                                                <div class="box-minimal-icon fa fa-envelope"></div>
                                                <div class="box-minimal-title">Email</div>
                                                <div class="box-minimal-divider"></div>
                                                <div id="user-email" class="box-minimal-text"><?= $user['email'] ?></div>
                                            </article>
                                        </div>
                                        <div class="cell-xs-6 cell-md-4">
                                            <article class="box-minimal">
                                                <div class="box-minimal-icon fa fa-map-marker"></div>
                                                <div class="box-minimal-title">Morada</div>
                                                <div class="box-minimal-divider"></div>
                                                <div id="user-address" class="box-minimal-text"><?= $user['morada'] . ", " . $user['zipCod'] ?></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 2 - Colocar para Adoção-->
                                <div class="tab-pane fade" id="tabs-1-2">
                                    <form id="put-for-adoption-form" class="rd-mailform" method="post" enctype="multipart/form-data" action="../actions/action_put_for_adoption.php?csrf=<?= $_SESSION['csrf'] ?>">
                                        <div class="range range-sm-bottom spacing-20">
                                            <div class="cell-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" id="pet-name" type="text" name="pet-name">
                                                    <label class="form-label" for="pet-name">Nome</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group">
                                                    <input class="form-control" id="pet-location" type="text" name="pet-location">
                                                    <label class="form-label" for="pet-location">Localização</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group">
                                                    <input class="form-control" id="pet-age" type="text" name="pet-age">
                                                    <label class="form-label" for="pet-age">Idade</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group">
                                                    <input class="form-control" id="pet-weight" type="text" name="pet-weight">
                                                    <label class="form-label" for="pet-weight">Peso</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-4">
                                                <div class="form-group custom-select">
                                                    <select class="form-control select-filter" id="pet-type" name="pet-type">
                                                        <option value="null">Tipo</option>
                                                        <option value="cao">Cão</option>
                                                        <option value="gato">Gato</option>
                                                        <option value="pequeno">Pequeno porte</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="profile-select-breeds" class="cell-sm-4">
                                                <div id="profile-select-all-breeds" class="form-group custom-select">
                                                    <select class="form-control select-filter" name="pet-breed-all">
                                                        <option value="null">Raça</option>
                                                        <?php
                                                        foreach ($allBreeds as $row) {
                                                            foreach ($row as $key => $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div id="profile-select-cat-breeds" class="form-group custom-select">
                                                    <select class="form-control select-filter" name="pet-breed-cats">
                                                        <option value="null">Raça</option>
                                                        <?php
                                                        foreach ($catBreeds as $row) {
                                                            foreach ($row as $key => $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div id="profile-select-dog-breeds" class="form-group custom-select">
                                                    <select class="form-control select-filter" name="pet-breed-dogs">
                                                        <option value="null">Raça</option>
                                                        <?php
                                                        foreach ($dogBreeds as $row) {
                                                            foreach ($row as $key => $value) {
                                                                echo '<option value="' . $value . '">' . $value . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div id="profile-select-small-animal-breeds" class="form-group custom-select">
                                                    <select class="form-control select-filter" name="pet-breed-small">
                                                        <option value="null">Raça</option>
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
                                            <div class="cell-sm-4">
                                                <div class="form-group custom-select">
                                                    <select class="form-control select-filter" id="pet-sex" name="pet-gender">

                                                        <option value="null">Género</option>
                                                        <option value="0">Macho</option>
                                                        <option value="1">Fêmea</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="cell-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="pet-desc" type="text" name="pet-desc"></textarea>
                                                    <label class="form-label" for="pet-desc">Descrição</label>
                                                </div>
                                            </div>

                                            <div class="cell-sm-6 center-content">
                                                <div class="btn btn-icon btn-icon-left btn-primary">
                                                    <span class="icon icon-md material-icons-vertical_align_top"></span>
                                                    <input type="file" class="custom-file-input" name="pet-img">
                                                </div>
                                            </div>
                                            <div class="cell-sm-6">
                                                <button class="btn btn-tan-hide btn-block" type="submit">Concluir</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Tab 3 - Editar Perfil-->
                                <div class="tab-pane fade" id="tabs-1-3">
                                    <form id="edit-user-profile-form" class="rd-mailform" data-form-output="form-output-global" method="post">
                                        <div class="range range-sm-bottom spacing-20">
                                            <div class="cell-sm-12">
                                                <div class="form-group">
                                                    <input class="form-control" id="profile-first-name" type="text" name="first-name" value="<?= $user['firstName'] ?>">
                                                    <label class="form-label" for="profile-first-name">Primeiro Nome</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-12">
                                                <div class="form-group">
                                                    <input class="form-control" id="profile-last-name" type="text" name="last-name" value="<?= $user['lastName'] ?>">
                                                    <label class="form-label" for="profile-last-name">Último Nome</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-8">
                                                <div class="form-group">
                                                    <input class="form-control" id="profile-address" type="text" name="address" value="<?= $user['morada'] ?>">
                                                    <label class="form-label" for="profile-address">Morada</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-4">
                                                <div class="form-group">
                                                    <input class="form-control" id="profile-zipcod" type="text" name="zip-cod" value="<?= $user['zipCod'] ?>">
                                                    <label class="form-label" for="profile-zipcod">Código Postal</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-6 center-content">
                                                <div class="btn btn-icon btn-icon-left btn-primary">
                                                    <span class="icon icon-md material-icons-vertical_align_top"></span>
                                                    <input type="file" class="custom-file-input" name="cover-img">
                                                </div>
                                            </div>

                                            <input type="text" name="email" value="<?= $_SESSION['email'] ?>" style="display: none">
                                            <input type="text" name="csrf" value="<?= $_SESSION['csrf'] ?>" style="display: none">

                                            <div class="cell-sm-5">
                                                <button id="btn-edit-profile" class="btn btn-tan-hide btn-block" type="submit">Concluir</button>
                                            </div>
                                            <div class="cell-sm-1">
                                                <div id="success"><i class="fas fa-check"></i></div>
                                                <!-- ajax loader-->
                                                <div id="edit-profile-loader" class="loadingio-spinner-spin-jcwopzzxjlr" style="display: none;">
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
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Tab 4 - Mensagens-->
                                <div class="tab-pane fade in" id="tabs-1-4" style="overflow-y: scroll; overflow-x: hidden; max-height: 400px;">
                                    <?php
                                    $i = 0;
                                    foreach ($messages as $row) :
                                        $i++;
                                    ?>
                                        <form class="rd-mailform form-label-centered" method="post" action="../actions/action_respond_to_message.php?csrf=<?= $_SESSION['csrf']; ?>">
                                            <div class="cell-sm-6">
                                                <h6>De: </h6>
                                                <p><?= getSenderEmail($row['idSender']); ?></p>
                                            </div>

                                            <div class="cell-sm-12">
                                                <h6>Mensagem: </h6>
                                                <p><?= $row['body']; ?></p>
                                            </div>

                                            <div class="cell-sm-12">
                                                <input type="text" name="sender-id" value="<?= $row['idSender']; ?>" style="display: none">

                                                <div class="form-group">
                                                    <textarea class="form-control" id="message<?= $i; ?>" type="text" name="message"></textarea>
                                                    <label class="form-label" for="message<?= $i; ?>">Responder</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-12">
                                                <button class="btn btn-tan-hide btn-block" type="submit">Enviar</button>
                                            </div>
                                        </form>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Tab 5 - Pedidos de Adoção-->
                                <div class="tab-pane fade in" id="tabs-1-5" style="overflow-y: scroll; overflow-x: hidden; max-height: 300px;">

                                    <div class="range spacing-20">
                                        <div class="cell-sm-12">
                                            <?php foreach ($adoptionRequests as $row) : ?>
                                                <div class="cell-sm-12">
                                                    <h5>Novo Pedido</h5>
                                                </div>
                                                <form class="rd-mailform respond-to-adoption-request-form" method="post" action="../actions/action_respond_to_adoption_request.php?csrf=<?= $_SESSION['csrf']; ?>">
                                                    <input style="display: none;" type="text" name="pet-id" value="<?= $row['idPet']; ?>">
                                                    <input style="display: none;" type="text" name="user-id" value="<?= $row['idUser']; ?>">

                                                    <div class="range range-sm-bottom spacing-20">
                                                        <div class="cell-sm-4">
                                                            <h6>Animal: </h6>
                                                            <p><?= $row['name']; ?></p>
                                                        </div>
                                                        <div class="cell-sm-4">
                                                            <h6>Pedido efetuado por: </h6>
                                                            <p><?= $row['firstName'] . " " . $row['lastName']; ?></p>
                                                        </div>

                                                        <div class="cell-sm-4">
                                                            <h6 style="margin-bottom: 10px">Responder: </h6>
                                                            <div class="form-group custom-select">
                                                                <select class="form-control select-filter" name="adoption-response">
                                                                    <option value="NULL">Resposta</option>
                                                                    <option value="1">Aceitar</option>
                                                                    <option value="0">Rejeitar</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="cell-sm-12">
                                                            <h6>Mensagem: </h6>
                                                            <p><?= $row['adoptionProposal']; ?></p>
                                                        </div>

                                                        <div class="cell-sm-12">
                                                            <button class="btn btn-tan-hide btn-block" type="submit">Enviar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>

                                <!-- Tab 6 - Perdidos e Achados-->
                                <div class="tab-pane fade" id="tabs-1-6">
                                    <form id="put-for-adoption-form" class="rd-mailform" method="post" enctype="multipart/form-data" action="../actions/action_add_lost_and_found.php?csrf=<?= $_SESSION['csrf'] ?>">
                                        <div class="range range-sm-bottom spacing-20">
                                            <div class="cell-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" id="lost-and-found-title" type="text" name="lost-and-found-title">
                                                    <label class="form-label" for="lost-and-found-title">Título</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group">
                                                    <input class="form-control" id="lost-and-found-contact" type="text" name="lost-and-found-contact">
                                                    <label class="form-label" for="lost-and-found-contact">Contacto</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group">
                                                    <input class="form-control" id="lost-and-found-location" type="text" name="lost-and-found-location">
                                                    <label class="form-label" for="lost-and-found-location">Localização</label>
                                                </div>
                                            </div>
                                            <div class="cell-sm-2">
                                                <div class="form-group custom-select">
                                                    <select class="form-control select-filter" id="lost-and-found-type" name="lost-and-found-type">
                                                        <option value="null">Tipo</option>
                                                        <option value="cao">Cão</option>
                                                        <option value="gato">Gato</option>
                                                        <option value="pequeno">Pequeno porte</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="cell-sm-6 center-content">
                                                <div class="btn btn-icon btn-icon-left btn-primary">
                                                    <span class="icon icon-md material-icons-vertical_align_top"></span>
                                                    <input type="file" class="custom-file-input" name="lost-and-found-img">
                                                </div>
                                            </div>
                                            <div class="cell-sm-6">
                                                <button class="btn btn-tan-hide btn-block" type="submit">Concluir</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Os Meus Animais-->
        <section class="section-md bg-white text-center">
            <div class="shell">
                <h3>Os meus animais para adoção</h3>
                <!-- Tabs-->
                <div class="tabs tabs-custom tabs-vertical tabs-corporate tabs-wide" id="tabs-1" data-url-tabs="true">
                    <!-- Nav tabs-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#adopt-cats" data-toggle="tab">Gatos</a></li>
                        <li><a href="#adopt-dogs" data-toggle="tab">Cães</a></li>
                        <li><a href="#adopt-small-pets" data-toggle="tab">Pequeno Porte</a></li>
                    </ul>
                    <!-- Tab panes-->
                    <div class="tab-content">
                        <!-- Tab 1-->
                        <div class="tab-pane fade in active" id="adopt-cats">
                            <div class="range spacing-30">
                                <?php foreach ($cats as $row) : ?>
                                    <div class="cell-md-6">
                                        <!-- Thumbnail boxed vertical-->
                                        <div class="thumbnail-boxed thumbnail-boxed-vertical">
                                            <div class="thumbnail-boxed-left">
                                                <img class="thumbnail-boxed-image" src="../../images/adopt/<?= $row['image'] ?>" alt="" width="370" height="240" />
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
                                                        <li>
                                                            <span class="icon icon-xs icon-tan-hide material-icons-event_available"></span>
                                                            <span><?= $row['age'] ?> anos</span>
                                                        </li>
                                                        <li>
                                                            <span class="icon icon-xs icon-tan-hide material-icons-done"></span>
                                                            <span><?= $row['weight'] ?> kg</span>
                                                        </li>
                                                        <li>
                                                            <span class="icon icon-xs icon-tan-hide material-icons-place"></span>
                                                            <span><?= $row['location'] ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- Tab Navigation-->
                            <ul id="profile-cats-pagination" class="pagination-custom">
                                <li class="<?= $pageNo == 1 ? 'disabled' : ''; ?>"><a href="user-profile.php?pageNo=<?= $pageNo - 1; ?>#adopt-cats" aria-label="Previous"></a></li>
                                <?php for ($i = 1; $i <= $catsTotalPages; $i++) : ?>
                                    <li class="<?= $i == $pageNo ? 'active' : ''; ?>"><a href="user-profile.php?pageNo=<?= $i; ?>#adopt-cats"><?= $i; ?></a></li>
                                <?php endfor; ?>
                                <li class="<?= $pageNo == $catsTotalPages ? 'disabled' : ''; ?>"><a href=" user-profile.php?pageNo=<?= $pageNo + 1; ?>#adopt-cats" aria-label="Next"></a></li>
                            </ul>
                        </div>

                        <!-- Tab 2-->
                        <div class="tab-pane fade" id="adopt-dogs">
                            <div class="range spacing-30">
                                <?php foreach ($dogs as $row) : ?>
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
                            <ul id="profile-dogs-pagination" class="pagination-custom">
                                <li class="<?= $pageNo == 1 ? 'disabled' : ''; ?>"><a href="user-profile.php?pageNo=<?= $pageNo - 1; ?>#adopt-dogs" aria-label="Previous"></a></li>
                                <?php for ($j = 1; $j <= $dogsTotalPages; $j++) : ?>
                                    <li class="<?= $j == $pageNo ? 'active' : ''; ?>"><a href="user-profile.php?pageNo=<?= $j; ?>#adopt-dogs"><?= $j; ?></a></li>
                                <?php endfor; ?>
                                <li class="<?= $pageNo == $dogsTotalPages ? 'disabled' : ''; ?>"><a href="user-profile.php?pageNo=<?= $pageNo + 1; ?>#adopt-dogs" aria-label="Next"></a></li>
                            </ul>
                        </div>

                        <!-- Tab 3-->
                        <div class="tab-pane fade" id="adopt-small-pets">
                            <div class="range spacing-70">
                                <div class="cell-xs-12">
                                    <div class="range spacing-negative-1">
                                        <div class="cell-md-6">
                                            <!-- Animal (max 4)-->
                                            <?php if (sizeof($smallAnimals) > 0): ?>
                                                <?php for ($i = 0; $i < 4; $i++) : ?>
                                                    <a class="thumbnail-minimal" href="pet.php?idPet=<?= $smallAnimals[$i]['idPet']; ?>">
                                                        <div class="thumbnail-minimal-left">
                                                            <img class="thumbnail-minimal-image-minimal" src="../../images/adopt/<?= $smallAnimals[$i]['image']; ?>" alt="" width="96" height="107" />
                                                        </div>
                                                        <div class="thumbnail-minimal-body">
                                                            <p class="thumbnail-minimal-title"><?= $smallAnimals[$i]['name']; ?></p>
                                                            <p class="thumbnail-minimal-subtitle">
                                                                <?= getBreed($smallAnimals[$i]['idBreed']); ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="cell-md-6">
                                            <!-- Animal (max 4)-->
                                            <?php if (sizeof($smallAnimals) > 4) : ?>
                                                <?php for ($i = 4; $i < sizeof($smallAnimals); $i++) : ?>
                                                    <a class="thumbnail-minimal" href="pet.php?idPet=<?= $smallAnimals[$i]['idPet']; ?>">
                                                        <div class="thumbnail-minimal-left">
                                                            <img class="thumbnail-minimal-image-minimal" src="../../images/adopt/<?= $smallAnimals[$i]['image']; ?>" alt="" width="96" height="107" />
                                                        </div>
                                                        <div class="thumbnail-minimal-body">
                                                            <p class="thumbnail-minimal-title"><?= $smallAnimals[$i]['name']; ?></p>
                                                            <p class="thumbnail-minimal-subtitle">
                                                                <?= getBreed($smallAnimals[$i]['idBreed']); ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Os Meus Favoritos-->
        <section class="section-md bg-white text-center">
            <div class="shell isotope-wrap">
                <h2>Favoritos</h2>
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
                    <?php foreach ($favourites as $row) : ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 isotope-item" data-filter="<?= getAnimalType($row['idType']); ?>">
                            <a class="thumbnail-classic" href="pet.php?idPet=<?= $row['idPet']; ?>">
                                <figure class="box-lost-and-found">
                                    <img src="../../images/adopt/<?= $row['image']; ?>" alt="" width="370" height="320" />
                                </figure>
                                <div class="caption">
                                    <p class="caption-title"><?= $row['name']; ?></p>
                                    <p class="caption-text"><?= $row['location']; ?></p>
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