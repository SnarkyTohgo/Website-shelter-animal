<?php
    include_once('../includes/database.php');
    include_once('db_user.php');

    function insertAdopt($email, $petId, $message) {
        $db = Database::instance()->db();

        $userId = getUserId($email);

        $stmt = $db->prepare('INSERT INTO Adopt (idUser, idPet, adoptionProposal)
                                VALUES (?, ?, ?)');

        $stmt->execute(array($userId, $petId, $message));
    }
    
    function updateAdopt($userId, $petId, $response) {
        $db = Database::instance()->db();

        $date = date("Y-m-d");

        $stmt = $db->prepare('UPDATE Adopt SET adoptionDate = ?, proposalResponse = ?, responded = 1 WHERE idUser = ? AND idPet = ?');
        $stmt->execute(array($date, $response, $userId, $petId));
    }

    function getAdoptionRequests() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT 
                                Adopt.idUser,
                                Adopt.idPet,
                                Adopt.adoptionProposal,
                                User.email,
                                User.firstName,
                                User.lastName,
                                Pet.name
                            FROM Adopt
                            JOIN User
                                ON Adopt.idUser = User.idUser
                            JOIN Pet
                                ON Adopt.idPet = Pet.idPet
                            WHERE
                                Adopt.responded = 0');
                
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }
?>