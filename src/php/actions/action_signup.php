<?php
    include_once('../includes/session.php');
    include_once('../db/db_user.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $pattern = '/(?:[a-z0-9!#$%&*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/';

    if (!preg_match($pattern, $email)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email inválido!');
        die(header('Location: ../pages/register.php'));
    }

    try {
        insertUser($email, $password);
        $_SESSION['email'] = $email;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Sign up e log in efetuados com sucesso!');
        header('Location: ../pages/create-profile.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Signup falhou!');
        header('Location: ../pages/register.php');
    }
?>