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
    $title = $_POST['lost-and-found-title'];
    $contact = $_POST['lost-and-found-contact'];
    $location = $_POST['lost-and-found-location'];
    $rawType = $_POST['lost-and-found-type'];

    if (isset($_FILES['lost-and-found-img'])) {
        $hasImg = true;
        $img = $_FILES['lost-and-found-img']['name'];
    }
 

    try {
        if ($hasImg) {
            insertLostAndFoundWithImg($title, $contact, $location, $email, $img, $rawType);
            fileUpload("/../../images/lost-and-found/", "lost-and-found-img");
        } else {
            insertLostAndFound($title, $contact, $location, $email, $rawType);
        }

        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Colocar para adoção efetuado com sucesso!');
        header('Location: ../pages/user-profile.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Colocar para adoção falhou!');
        header('Location: ../pages/user-profile.php');
    }
