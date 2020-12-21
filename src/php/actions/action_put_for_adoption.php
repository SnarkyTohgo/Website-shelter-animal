<?php
    include_once('../includes/session.php');
    include_once('../includes/utils.php');
    include_once('../db/db_pet.php');
 
    // Verify if user is logged in
    if (!isset($_SESSION['email']))
        die(header('Location: ../pages/login.php'));

    // Verifies CSRF token
    if ($_SESSION['csrf'] != $_GET['csrf']) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ../pages/login.php'));
    }

    $hasImg = false;
        
    $email = $_SESSION['email'];
    $name = $_POST['pet-name'];
    $location = $_POST['pet-location'];
    $age = $_POST['pet-age'];
    $weight = $_POST['pet-weight'];
    $gender = $_POST['pet-gender'];
    $desc = $_POST['pet-desc'];
    $rawType = $_POST['pet-type'];
    $rawBreedAll = $_POST['pet-breed-all'];
    $rawBreedCats = $_POST['pet-breed-cats'];
    $rawBreedDogs = $_POST['pet-breed-dogs'];
    $rawBreedSmall = $_POST['pet-breed-small'];

    $rawBreed;
    $rawBreeds = array($rawBreedAll, $rawBreedCats, $rawBreedDogs, $rawBreedSmall);
    foreach ($rawBreeds as $breed) {
        if ($breed != "null") {
            $rawBreed = $breed;
        }
    }

    if (isset($_FILES['pet-img'])) {
        $hasImg = true;
        $img = $_FILES['pet-img']['name'];
    }
 

    try {
        if ($hasImg) {
            insertPetWithImg($email, $name, $location, $age, $weight, $gender, $desc, $img, $rawType, $rawBreed);
            fileUpload("/../../images/adopt/", "pet-img");
        } else {
            insertPet($email, $name, $location, $age, $weight, $gender, $desc, $rawType, $rawBreed);
        }

        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Colocar para adoção efetuado com sucesso!');
        header('Location: ../pages/user-profile.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Colocar para adoção falhou!');
        header('Location: ../pages/user-profile.php');
    }
?>