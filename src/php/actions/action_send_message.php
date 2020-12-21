<?php
    include_once('../includes/warnings.php');
    include_once('../includes/session.php');
    include_once('../db/db_message.php');

    // Verify if user is logged in
    if (!isset($_SESSION['email']))
        die(header('Location: ../pages/login.php'));

    // Verifies CSRF token
    if ($_SESSION['csrf'] != $_GET['csrf']) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ../pages/login.php'));
    }

    $from = $_SESSION['email'];
    $to = $_POST['receiverId'];
    $message = $_POST['message'];
 
    try {
        insertMessage($from, $to, $message);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Mensagem enviada com sucesso!');
    } catch (PDOException $e) {
        die($e->getMessage());

        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Envio de mensagem falhou!');
    }
?>