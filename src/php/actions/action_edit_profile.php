<?php
    include_once('../includes/warnings.php');
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

    $email = $_POST['email'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $addr = $_POST['addr'];
    $zipCod = $_POST['zipCod'];

    if (isset($_FILES['img'])) {
        $hasImg = true;
        $img = $_FILES['img']['name'];
    }
 
    try {
        if ($hasImg) {
            updateUserWithImg($email, $fName, $lName, $addr, $zipCod, $img);
            fileUpload("/../../images/users/", "img");
        } else {
            updateUser($email, $fName, $lName, $addr, $zipCod);
        }

        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Edição de perfil efetuada com sucesso!');
    } catch (PDOException $e) {
        die($e->getMessage());

        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Edição de perfil falhou!');
    }
?>