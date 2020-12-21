<?php
    include_once('../includes/warnings.php');
    include_once('../includes/session.php');
    include_once('../db/db_favourite.php');

    // Verify if user is logged in
    if (!isset($_SESSION['email']))
        die(header('Location: ../pages/login.php'));

    // Verifies CSRF token
    if ($_SESSION['csrf'] != $_GET['csrf']) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ../pages/login.php'));
    }

    $email = $_SESSION['email'];
    $petId = $_POST['petId'];
 
    try {
        insertFavourite($email, $petId);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Edição de perfil efetuada com sucesso!');
    } catch (PDOException $e) {
        die($e->getMessage());

        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Edição de perfil falhou!');
    }
?>