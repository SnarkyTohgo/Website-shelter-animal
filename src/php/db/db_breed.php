<?php
    include_once('../includes/database.php');

    function getBreedId($breedName) {
        $db = Database::instance()->db();
        
        if ($breedName == 'null') {
            return 'null';
        }

        $stmt = $db->prepare('SELECT idBreed FROM Breed WHERE name = ?');
        $stmt->execute(array($breedName));
        $row = $stmt->fetch();

        return $row['idBreed'];
    }

    function getBreed($idBreed) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM Breed WHERE idBreed = ?');
        $stmt->execute(array($idBreed));
        $row = $stmt->fetch();

        return $row['name'];
    }

    function getAllBreeds() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM Breed ORDER BY name ASC');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getCatBreeds() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM Breed WHERE idType = 2 ORDER BY name ASC');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getDogBreeds() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM Breed WHERE idType = 1 ORDER BY name ASC');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getSmallAnimalBreeds() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name FROM Breed WHERE idType = 3 ORDER BY name ASC');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }
?>

