<?php
    include_once('../includes/database.php');
    include_once('db_user.php');
    include_once('db_breed.php');
    include_once('db_type.php');


    function insertFavourite($email, $petId) {
        $db = Database::instance()->db();

        $userId = getUserId($email);

        $stmt = $db->prepare('INSERT INTO Favourite (idUser, idPet)
                                VALUES (?, ?)');

        $stmt->execute(array($userId, $petId));
    }

    function getFavourites($email) {
        $db = Database::instance()->db();

        $userId = getUserId($email);

        $stmt = $db->prepare("SELECT 
                                * 
                            FROM 
                                Favourite 
                                JOIN 
                                    User 
                                    On
                                        Favourite.idUser = User.idUser
                                JOIN
                                    Pet
                                    ON
                                        Favourite.idPet = Pet.idPet  
                            WHERE 
                                Favourite.idUser = ?");

        $stmt->execute(array($userId));
        $rows = $stmt->fetchAll();

        return $rows;
    }

?>