<?php
    include_once('../includes/session.php');
    include_once('../includes/utils.php');
    include_once('../db/db_user.php');
 
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
    $fName = $_POST['first-name'];
    $lName = $_POST['last-name'];
    $addr = $_POST['address'];
    $zipCod = $_POST['zip-cod'];
    
    if (isset($_FILES['cover-img'])) {
        $hasImg = true;
        $img = $_FILES['cover-img']['name'];
    }
 
    try {
        if ($hasImg) {
            updateUserWithImg($email, $fName, $lName, $addr, $zipCod, $img);
            fileUpload("/../../images/users/", "cover-img");
        } else {
            updateUser($email, $fName, $lName, $addr, $zipCod);
        }

        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Criação de perfil efetuada com sucesso!');
        header('Location: ../pages/user-profile.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Criação de perfil falhou!');
        header('Location: ../pages/create-profile.php');
    }
?>