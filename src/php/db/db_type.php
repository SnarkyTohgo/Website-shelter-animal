<?php
    include_once('../includes/database.php');

    function getTypeId($typeName) {
        $db = Database::instance()->db();
        
        if ($typeName == 'null') {
            return 'null';
        }

        $stmt = $db->prepare('SELECT idType FROM Type WHERE name = ?');
        $stmt->execute(array($typeName));
        $row = $stmt->fetch();
        
        return $row['idType'];
    }

    function getAnimalType($typeId) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare('SELECT name FROM Type WHERE idType = ?');
        $stmt->execute(array($typeId));
        $row = $stmt->fetch();
        
        return $row['name'];
    }
?>