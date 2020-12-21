<?php 
    include_once("../includes/warnings.php");
    include_once("../includes/session.php");
    include_once("../db/db_user.php");

    $email = $_POST['email'];    
    $password = $_POST['password'];
    

    if (checkUserPassword($email, $password)) {
        $_SESSION['email'] = $email;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Entrou com sucesso!');
        header('Location: ../../index.php');
    } else {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login falhou!');
        header('Location: ../pages/login.php');
    }
?>