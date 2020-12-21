<?php
    include_once('../includes/database.php');
    include_once('db_user.php');
    include_once('db_breed.php');
    include_once('db_type.php');


    // INSERT LOST&FOUND

    function insertLostAndFoundWithImg($title, $contact, $location, $email, $img, $rawType) {
        $db = Database::instance()->db();

        $typeId = getTypeId($rawType);

        $stmt = $db->prepare('INSERT INTO LostAndFound (title, contact, location, email, image, idType)
                                VALUES (?, ?, ?, ?, ?, ?)');

        $stmt->execute(array($title, $contact, $location, $email, $img, $typeId));
    }

    function insertLostAndFound($title, $contact, $location, $email, $rawType) {
        $db = Database::instance()->db();

        $typeId = getTypeId($rawType);

        $stmt = $db->prepare('INSERT INTO LostAndFound (title, contact, location, email, idType)
                                VALUES (?, ?, ?, ?, ?, ?)');

        $stmt->execute(array($title, $contact, $location, $email, $typeId));
    }


    // INSERT PET

    function insertPet($email, $name, $location, $age, $weight, $gender, $desc, $rawType, $rawBreed) {
        $db = Database::instance()->db();

        $userId = getUserId($email);
        $typeId = getTypeId($rawType);
        $breedId = getBreedId($rawBreed);

        $stmt = $db->prepare('INSERT INTO Pet (name, age, gender, weight, location, description, idType, idBreed, idUser)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $stmt->execute(array($name, $age, $gender, $weight, $location, $desc, $typeId, $breedId, $userId));
    }

    function insertPetWithImg($email, $name, $location, $age, $weight, $gender, $desc, $img, $rawType, $rawBreed) {
        $db = Database::instance()->db();

        $userId = getUserId($email);
        $typeId = getTypeId($rawType);
        $breedId = getBreedId($rawBreed);

        $stmt = $db->prepare('INSERT INTO Pet (name, age, gender, weight, location, description, image, idType, idBreed, idUser)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $stmt->execute(array($name, $age, $gender, $weight, $location, $desc, $img, $typeId, $breedId, $userId));
    }


    // LOST&FOUND

    function getLostAndFound() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM lostAndFound JOIN Type ON lostAndFound.idType = Type.idType');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    // GET PET

    function getPet($petId) {
        $db = Database::instance()->db();

        $stmt = $db->prepare("SELECT * FROM Pet WHERE idPet = ?");
        $stmt->execute(array($petId));
        $row = $stmt->fetch();

        return $row;
    }

    // GET SEARCH RESULTS

    function getSearchResults($type, $breed, $gender, $age, $pageNo) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $offset = ($pageNo - 1) * $recordsPerPage;

        if ($age == 1) {
            // 0-5 years
            if ($gender != 'null') {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed AND gender = :gender AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND gender = :gender AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = :idBreed AND gender = :gender AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE gender = :gender AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');

                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                    
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                    
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = :idBreed AND age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE age >= 0 AND age <= 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } 
                }
            }
            
        } else if ($age == 2) {
            // 5+ years
            if ($gender != 'null') {
                if ($type != 'null') {
                    $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed AND gender = :gender AND age > 5 LIMIT :offset, :recPerPage');
                    
                    $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                    $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                    $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                    $stmt->execute();
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = idBreed AND gender = :gender AND age > 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE gender = :gender AND age > 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed AND age > 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND age > 5 LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = :idBreed AND age > 5 LIMIT :offset, :recPerPage');
                    
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE age > 5 LIMIT :offset, :recPerPage');
                    
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                }
            }
        } else {
            // any age
            if ($gender != 'null') {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed AND gender = :gender LIMIT :offset, :recPerPage');

                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND gender = :gender LIMIT :offset, :recPerPage');
                    
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = :idBreed AND gender = :gender LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE gender = :gender LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType AND idBreed = :idBreed LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = :idType LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idType', $type, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT * FROM Pet WHERE idBreed = :idBreed LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':idBreed', $breed, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

                        $stmt->execute();
                    } else {
                        $stmt = $db->prepare('SELECT * FROM Pet LIMIT :offset, :recPerPage');
                        
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);
                        
                        $stmt->execute();
                    }
                }
            }
        }
        
        $rows = $stmt->fetchAll();
        return $rows;
    }

    // GET ALL ANIMALS

    function getTotalPets() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT COUNT(idPet) AS totalPets FROM Pet');
        $stmt->execute();
        $row = $stmt->fetch();

        return $row['totalPets'];
    }

    function getAdoptedPets() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT COUNT(idPet) AS totalPets FROM Pet WHERE adopted = 1');
        $stmt->execute();
        $row = $stmt->fetch();

        return $row['totalPets'];
    }

    function getAllDogs($pageNo) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $offset = ($pageNo - 1) * $recordsPerPage;

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 1 AND adopted = 0 LIMIT :offset, :recPerPage');

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getAllCats($pageNo) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $offset = ($pageNo - 1) * $recordsPerPage;

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 2 AND adopted = 0 LIMIT :offset, :recPerPage');

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getAllSmallAnimals() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 3 AND adopted = 0');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }


    // GET USER ANIMALS

    function getUserDogs($email, $pageNo) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $offset = ($pageNo - 1) * $recordsPerPage;

        $userId = getUserId($email);

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 1 AND adopted = 0 AND idUser = :idUser LIMIT :offset, :recPerPage');
        
        $stmt->bindParam(':idUser', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);
        
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    
    function getUserCats($email, $pageNo) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $offset = ($pageNo - 1) * $recordsPerPage;

        $userId = getUserId($email);

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 2 AND adopted = 0 AND idUser = :idUser LIMIT :offset, :recPerPage');
        
        $stmt->bindParam(':idUser', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':recPerPage', $recordsPerPage, PDO::PARAM_INT);
        
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }


    function getUserSmallAnimals($email) {
        $db = Database::instance()->db();

        $userId = getUserId($email);

        $stmt = $db->prepare('SELECT * FROM Pet WHERE idType = 3 AND idUser = ? AND adopted = 0');
        $stmt->execute(array($userId));
        $rows = $stmt->fetchAll();

        return $rows;
    }


    // GET TOTAL PAGES

    function getResultsTotalPages($type, $breed, $gender, $age) {
        $db = Database::instance()->db();

        if ($age == 1) {
            // 0-5 years
            if ($gender != 'null') {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ? AND gender = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($type, $breed, $gender));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND gender = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($type, $gender));
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ? AND gender = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($breed, $gender));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE gender = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($gender));
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($type, $breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($type));
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ? AND age >= 0 AND age <= 5');
                        $stmt->execute(array($breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE age >= 0 AND age <= 5');
                        $stmt->execute();
                    }
                }
            }
        } else if ($age == 2) {
            // 5+ years
            if ($gender != 'null') {
                if ($type != 'null') {
                    $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ? AND gender = ? AND age > 5');
                    $stmt->execute(array($type, $breed, $gender));
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ? AND gender = ? AND age > 5');
                        $stmt->execute(array($breed, $gender));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE gender = ? AND age > 5');
                        $stmt->execute(array($gender));
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ? AND age > 5');
                        $stmt->execute(array($type, $breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND age > 5');
                        $stmt->execute(array($type));
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ? AND age > 5');
                        $stmt->execute(array($breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE age > 5');
                        $stmt->execute();
                    }
                }
            }
        } else {
            // any age
            if ($gender != 'null') {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ? AND gender = ?');
                        $stmt->execute(array($type, $breed, $gender));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND gender = ?');
                        $stmt->execute(array($type, $gender));
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ? AND gender = ?');
                        $stmt->execute(array($breed, $gender));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE gender = ?');
                        $stmt->execute(array($gender));
                    }
                }
            } else {
                if ($type != 'null') {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ? AND idBreed = ?');
                        $stmt->execute(array($type, $breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = ?');
                        $stmt->execute(array($type));
                    }
                } else {
                    if ($breed != 'null') {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idBreed = ?');
                        $stmt->execute(array($breed));
                    } else {
                        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet');
                        $stmt->execute();
                    }
                }
            }
        }
        
        $row = $stmt->fetch();
        $recordsPerPage = 4;
        $totalPages = ceil($row['COUNT(idPet)'] / $recordsPerPage);

        return $totalPages;
    }

    function getUserCatsTotalPages($email) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $userId = getUserId($email);

        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = 2 AND idUser = ? AND adopted = 0');
        $stmt->execute(array($userId));
        $totalRows = $stmt->fetch();
        
        $totalPages = ceil($totalRows['COUNT(idPet)'] / $recordsPerPage);
       
        return $totalPages;
    }

    function getUserDogsTotalPages($email) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;
        $userId = getUserId($email);

        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = 1 AND idUser = ? AND adopted = 0');
        $stmt->execute(array($userId));
        $totalRows = $stmt->fetch();
        
        $totalPages = ceil($totalRows['COUNT(idPet)'] / $recordsPerPage);
       
        return $totalPages;
    }

    function getAllDogsTotalPages($email) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;

        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = 1 AND adopted = 0');
        $stmt->execute();
        $totalRows = $stmt->fetch();
        
        $totalPages = ceil($totalRows['COUNT(idPet)'] / $recordsPerPage);
       
        return $totalPages;
    }

    function getAllCatsTotalPages($email) {
        $db = Database::instance()->db();

        $recordsPerPage = 4;

        $stmt = $db->prepare('SELECT COUNT(idPet) FROM Pet WHERE idType = 2 AND adopted = 0');
        $stmt->execute();
        $totalRows = $stmt->fetch();
        
        $totalPages = ceil($totalRows['COUNT(idPet)'] / $recordsPerPage);
       
        return $totalPages;
    }
?>