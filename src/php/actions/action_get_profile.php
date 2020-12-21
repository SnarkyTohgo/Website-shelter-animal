<?php
    include_once('../includes/warnings.php');
    include_once('../includes/session.php');
    include_once('../includes/utils.php');
    include_once('../db/db_user.php');

    header('Content-Type: application/json');

    // Verify if user is logged in
    if (!isset($_SESSION['email']))
        die(header('Location: ../pages/login.php'));

    try {
        echo getUserJson($_SESSION['email']);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Busca de perfil efetuada com sucesso!');
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Busca de perfil falhou!');
    }
