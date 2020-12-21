<?php
    include_once('../includes/database.php');
    include_once('db_user.php');

    /**
     * insertMessage
     * @description Adds a new entry to the Message table
     * 
     * @param from email of the sender
     * @param to id of the receiver
     * @param message message to deliver
     */
    function insertMessage($from, $to, $message) {
        $db = Database::instance()->db();

        $receiverId = $to;
        $senderId = getUserId($from);
        $date = date("Y-m-d");

        $stmt = $db->prepare('INSERT INTO Message (messageDate, body, idSender, idReceiver)
                                VALUES (?, ?, ?, ?)');

        $stmt->execute(array($date, $message, $senderId, $receiverId));
    }

    /**
     * updateMessage
     * @description Updates an existing entry in the Message 
     *              table corresponding to the message responded to
     *  
     * @param originalSender id of the original sender of the message
     * @param originalReceiver id of the original receiver of the message
     */
    function updateMessage($originalSenderId, $originalReceiverEmail) {
        $db = Database::instance()->db();

        $originalReceiverId = getUserId($originalReceiverEmail);

        $stmt = $db->prepare('UPDATE Message SET hasResponse = 1 WHERE idSender = ? AND idReceiver = ?');
        $stmt->execute(array($originalSenderId, $originalReceiverId));
    }


    function getMessages($receiver) {
        $db = Database::instance()->db();

        $receiverId = getUserId($receiver);

        $stmt = $db->prepare('SELECT * FROM Message WHERE idReceiver = ? AND hasResponse = 0 ORDER BY idMessage ASC');
        $stmt->execute(array($receiverId));
        $rows = $stmt->fetchAll();

        return $rows;
    }

    function getSenderEmail($senderId) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT 
                                email 
                            FROM 
                                Message
                            JOIN
                                User
                                ON 
                                    User.idUser = Message.idSender 
                            WHERE 
                                idSender = ? AND hasResponse = 0');

        $stmt->execute(array($senderId));
        $row = $stmt->fetch();

        return $row['email'];
    }

?>