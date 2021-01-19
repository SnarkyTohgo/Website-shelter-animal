<?php
    include_once("../includes/database.php");

    function checkUserPassword($email, $password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));

        $user = $stmt->fetch();
        return $user !== false && password_verify($password, $user['password']);
    }

    function insertUser($email, $password) {
        $db = Database::instance()->db();

        $options = ['cost' => 12];
        $pwdHash = password_hash($password, PASSWORD_DEFAULT, $options);

        $stmt = $db->prepare('INSERT INTO User (email, password) VALUES(?, ?)');
        $stmt->execute(array(htmlspecialchars($email), htmlspecialchars($pwdHash)));
    }

    function updateUser($email, $fName, $lName, $addr, $zipCod) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('UPDATE User 
                            SET firstName = ?,
                                lastName = ?,
                                morada = ?,
                                zipCod = ?
                            WHERE email = ?');


        $stmt->execute(array(htmlspecialchars($fName), htmlspecialchars($lName), htmlspecialchars($addr), htmlspecialchars($zipCod), htmlspecialchars($email)));        
    }

    function updateUserWithImg($email, $fName, $lName, $addr, $zipCod, $img) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('UPDATE User 
                            SET firstName = ?,
                                lastName = ?,
                                morada = ?,
                                zipCod = ?,
                                coverImg = ?
                            WHERE email = ?');


        $stmt->execute(array(htmlspecialchars($fName), htmlspecialchars($lName), htmlspecialchars($addr), htmlspecialchars($zipCod), $img, htmlspecialchars($email)));        
    }

    function getUserId($email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT idUser FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $row = $stmt->fetch();

        return $row['idUser'];
    }

    function getUser($email) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $row = $stmt->fetch();
        
        return $row;
    }

    function getUserJson($email) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $row = $stmt->fetch();

        return json_encode($row, JSON_PRETTY_PRINT);
    }
?>