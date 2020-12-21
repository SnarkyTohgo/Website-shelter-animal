<?php
    include_once('../includes/warnings.php');
    include_once('../includes/session.php');
    include_once('../db/db_adopt.php');

    // Verify if user is logged in
    if (!isset($_SESSION['email']))
        die(header('Location: ../pages/login.php'));

    // Verifies CSRF token
    if ($_SESSION['csrf'] != $_GET['csrf']) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ../pages/login.php'));
    }

    $userId = $_POST['user-id'];
    $petId = $_POST['pet-id'];
    $response = $_POST['adoption-response'];
    
    try {
        updateAdopt($userId, $petId, $response);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Edição de perfil efetuada com sucesso!');
        header('Location: ../pages/user-profile.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Edição de perfil falhou!');
        header('Location: ../pages/user-profile.php');
    }
?>