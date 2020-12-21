<?php
    $age = $_POST['search-age'];
    $gender = $_POST['search-gender'];
    $rawType = $_POST['search-type'];
    $rawBreedAll = $_POST['search-breed-all'];
    $rawBreedCats = $_POST['search-breed-cats'];
    $rawBreedDogs = $_POST['search-breed-dogs'];
    $rawBreedSmall = $_POST['search-breed-small'];

    $anyBreed = true;
    $rawBreed;
    $rawBreeds = array($rawBreedAll, $rawBreedCats, $rawBreedDogs, $rawBreedSmall);
    foreach ($rawBreeds as $breed) {
        if ($breed != "null") {
            $anyBreed = false;
            $rawBreed = $breed;
        } 
    }
 
    if ($anyBreed) {
        $rawBreed = 'null';
    }

    try {
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Pesquisa efetuada com sucesso!');
        header('Location: ../pages/search-results.php?type=' . $rawType . '&breed=' . $rawBreed . '&gender=' . $gender . '&age=' . $age);
    } catch (PDOException $e) {
        die($e->getMessage());
        
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pesquisa falhou!');
        header('Location: ../../index.php');
    }
