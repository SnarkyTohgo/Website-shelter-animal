<?php
include_once('../includes/database.php');
include_once('../includes/session.php');
include_once('../db/db_breed.php');
include_once('../db/db_pet.php');


// Pets
if (isset($_GET['pageNo'])) {
  $pageNo = $_GET['pageNo'];
} else {
  $pageNo = 1;
}

$dogsTotalPages = getAllDogsTotalPages($pageNo);
$catsTotalPages = getAllCatsTotalPages($pageNo);

$dogs = getAllDogs($pageNo);
$cats = getAllCats($pageNo);
$smallAnimals = getAllSmallAnimals();


?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <!-- Site Title-->
  <title>Adotar</title>
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
                <li class="active"><a href="adopt-a-pet.php">Adotar</a></li>
                <li><a href="lost-and-found.php">Perdidos e Achados</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Breadcrumbs & Page title-->
    <div class="page-title">
      <div class="page-title-text">
        <span data-content-to="#adopt-cats">Adotar Gatos</span>
        <span data-content-to="#adopt-dogs">Adotar Cães</span>
        <span data-content-to="#adopt-small-pets">Adotar Animais de Pequeno Porte</span>
      </div>

      <ul class="breadcrumbs-custom">
        <li><a href="../../index.php">Home</a></li>
        <li><a href="adopt-a-pet.php">Adotar</a></li>
        <li class="active">
          <span data-content-to="#adopt-cats">Adotar um Gato</span>
          <span data-content-to="#adopt-dogs">Adotar um Cão</span>
          <span data-content-to="#adopt-small-pets">Adotar um Animal de Pequeno Porte</span>
        </li>
      </ul>
    </div>

    <!-- Adotar animais-->
    <section class="section-md bg-white text-center">
      <div class="shell">
        <div data-content-to="#adopt-cats">
          <h3>Um destes gatos pode tornar-se seu</h3>
          <p class="big text-width-medium">
            De corajoso para dócil e fofinho para independente, a associação Patinhas Felizes tem dezenas de gatinhos à espera
            das suas casas-para-sempre. Dê uma olhada e veja qual é o gato certo para si!
          </p>
        </div>
        <div data-content-to="#adopt-dogs">
          <h3>Adote um cão, uma comanhia para si</h3>
          <p class="big text-width-smaller">
            Está à procura de um verdareiro melhor amigo para si e para a sua família?
            Considere adotar um cão da Patinhas Felizes ainda hoje!
          </p>
        </div>
        <div data-content-to="#adopt-small-pets">
          <h3>Animais de pequeno porte para adoção</h3>
          <p class="big text-width-small">
            Pequenos animais podem ser grandes companheiros. Se você não consegue sustentar um animal maior, ou se a sua casa
            é pequena, porque não adotar uma destas pequenas fofuras?
          </p>
        </div>
        <!-- Tabs-->
        <div class="tabs tabs-custom tabs-vertical tabs-corporate tabs-wide" id="tabs-1" data-url-tabs="true">
          <!-- Nav tabs-->
          <ul class="nav nav-tabs">
            <li class="active"><a href="#adopt-cats" data-toggle="tab">Adotar Gatos</a></li>
            <li><a href="#adopt-dogs" data-toggle="tab">Adotar Cães</a></li>
            <li><a href="#adopt-small-pets" data-toggle="tab">Adotar Animais de Pequeno Porte</a></li>
          </ul>
          <!-- Tab panes-->
          <div class="tab-content">
            <!-- Tab 1-->
            <div class="tab-pane fade in active" id="adopt-cats">
              <img class="img-responsive" src="../../images/adopt/adopt-cats-1-770x485.jpg" alt="" width="770" height="485" />

              <h4>Leve para Casa um Novo Gato</h4>
              <p>
                Escolher adotar um gatinho é algo entusiasmante. Ainda que haja uma dezena de coisas a ter em conta antes de adotar um animal,
                um gato da Patinhas Felizes pode facilmente tornar-se um novo membro da sua família e, mais importante, encontrar uma família
                e uma casa que o ame. Aqui estão os gatos e os gatinhos que lhe oferecemos para adoção.
              </p>

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
                <li class="<?= $pageNo == 1 ? 'disabled' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $pageNo - 1; ?>#adopt-cats" aria-label="Previous"></a></li>
                <?php for ($i = 1; $i <= $catsTotalPages; $i++) : ?>
                  <li class="<?= $i == $pageNo ? 'active' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $i; ?>#adopt-cats"><?= $i; ?></a></li>
                <?php endfor; ?>
                <li class="<?= $pageNo == $catsTotalPages ? 'disabled' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $pageNo + 1; ?>#adopt-cats" aria-label="Next"></a></li>
              </ul>
            </div>

            <!-- Tab 2-->
            <div class="tab-pane fade" id="adopt-dogs">
              <h4>Os nossos cães em destaque</h4>
              <p>
                No Patinhas Felizes, temos uma variedade de cães prontos para serem adotados hoje!
                Eles ficarão felizes por se tornarem os seus melhores amigos. Confira esta lista de cães em destaque à procura
                de bons lares.
              </p>

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
                <li class="<?= $pageNo == 1 ? 'disabled' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $pageNo - 1; ?>#adopt-dogs" aria-label="Previous"></a></li>
                <?php for ($j = 1; $j <= $dogsTotalPages; $j++) : ?>
                  <li class="<?= $j == $pageNo ? 'active' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $j; ?>#adopt-dogs"><?= $j; ?></a></li>
                <?php endfor; ?>
                <li class="<?= $pageNo == $dogsTotalPages ? 'disabled' : ''; ?>"><a href="adopt-a-pet.php?pageNo=<?= $pageNo + 1; ?>#adopt-dogs" aria-label="Next"></a></li>
              </ul>
            </div>

            <!-- Tab 3-->
            <div class="tab-pane fade" id="adopt-small-pets">
              <div class="range spacing-70">
                <div class="cell-md-6">
                  <img class="img-responsive" src="../../images/adopt/adopt-small-pets-1-370x240.jpg" alt="" width="370" height="240" />
                </div>
                <div class="cell-md-6 text-gray-darker">
                  <p>
                    Temos uma seleção de pequenos animais disponíveis para adoção. O nosso abrigo de animais oferece a
                    possibilidade de adotar quase todos os pequenos animais de estimação de diferentes formas e tamanhos e
                    que podem ser amigos ou companheiros perfeitos para a sua família. A nossa variedade de pequenos animais de
                    estimação inclui:
                  </p>
                  <ul class="marked-list">
                    <li>Hamsters</li>
                    <li>Coelhos</li>
                    <li>Papagaios</li>
                    <li>Catatuas</li>
                    <li>Iguanas</li>
                    <li>Piriquitos</li>
                    <li>Araras</li>
                  </ul>
                  e mais...
                </div>
                <div class="cell-xs-12">
                  <blockquote class="quote-primary">
                    <div class="quote-primary-body">
                      <svg class="quote-primary-mark" version="1.1" baseprofile="tiny" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="15px" viewbox="0 0 21 15" overflow="scroll" xml:space="preserve" preserveAspectRatio="none">
                        <path d="M9.597,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.349,1.316                                        c-1.287,0-2.414-0.44-3.382-1.316C0.482,12.811,0,11.758,0,10.535c0-1.226,0.58-2.716,1.739-4.473L5.603,0H9.34L6.956,6.37                                        C8.716,7.145,9.597,8.493,9.597,10.412z M20.987,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.35,1.316                                        c-1.288,0-2.415-0.44-3.381-1.316c-0.966-0.879-1.45-1.931-1.45-3.154c0-1.226,0.582-2.716,1.74-4.473L16.994,0h3.734l-2.382,6.37                                        C20.106,7.145,20.987,8.493,20.987,10.412z"></path>
                      </svg>
                      <div class="quote-primary-text">
                        <q>
                          Eu adotei um coelho chamado Max 2 anos atrás do vosso abrigo. Estou tão feliz que ele se juntou à minha
                          família. Todos os meus amigos e parentes estão tão apaixonados por ele. Ele traz um elemento de fofura
                          que eu não sabia que estava em falta. Obrigado pelo Max, ele agora é um verdadeiro membro da minha família.
                        </q>
                      </div>
                    </div>
                    <div class="quote-primary-footer">
                      <cite>Cristina Ferreira</cite>
                    </div>
                  </blockquote>
                </div>

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


