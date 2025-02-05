<?php

namespace Daos;


use Message;

require 'Dao.php';
require '..\business\Message.php';

class MessageDao extends Dao
{

    public function insertMessage(int $inboxId, int $senderId, string $message, int $messageType){
        $query = "INSERT INTO messages (inboxId, senderId, message, messageType, deletedState) VALUES (:inboxId, :senderId, :message, :messageType,false) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxId', $inboxId);
        $statement->bindValue(':senderId', $senderId);
        $statement->bindValue(':message', $message);
        $statement->bindValue(':messageType', $messageType);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in insertMessage" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }

    public function getMessages(int $inboxId):array {
        // $user = new User();
        $query = "SELECT * from messages where inboxId=:inboxId and deletedState=false order by timeSent desc limit 20;";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxId', $inboxId);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getInboxParticipants" . $ex->getMessage();
            exit();
        }
        $messages = $statement->fetchAll();
        $messagesArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($messages as $msg){
            $message= new Message();
            DateTime: $timeSent= new \DateTime($msg[5]);
            $message->message($msg[0],$msg[1],$msg[2],$msg[3],$msg[4],$timeSent,$msg[6]);
            array_push($messagesArray, $message);
        }
        return $messagesArray;
    }

    public function getPreviousMessages(int $inboxId, \DateTime $timeSent ):array {
        // $user = new User();
        $query = "SELECT * from messages where inboxId=:inboxId and deletedState=false and timeSent<=:timeSent order by timeSent desc limit 20;";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxId', $inboxId);
        $timeSent =$timeSent->format('Y-m-d H:i:s');
        $statement->bindValue(':timeSent', $timeSent);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getPreviousMessages" . $ex->getMessage();
            exit();
        }
        $messages = $statement->fetchAll();
        $messagesArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($messages as $msg){
            $message= new Message();
            DateTime: $timeSent= new \DateTime($msg[5]);
            $message->message($msg[0],$msg[1],$msg[2],$msg[3],$msg[4],$timeSent,$msg[6]);
            array_push($messagesArray, $message);
        }
        return $messagesArray;
    }
    public function getNewMessages(int $inboxId, \DateTime $timeSent ):array {
        // $user = new User();
        $query = "SELECT * from messages where inboxId=:inboxId and deletedState=false and timeSent>:timeSent;";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxId', $inboxId);
        $timeSent =$timeSent->format('Y-m-d H:i:s');
        $statement->bindValue(':timeSent', $timeSent);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getNewMessages" . $ex->getMessage();
            exit();
        }
        $messages = $statement->fetchAll();
        $messagesArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($messages as $msg){
            $message= new Message();
            DateTime: $timeSent= new \DateTime($msg[5]);
            $message->message($msg[0],$msg[1],$msg[2],$msg[3],$msg[4],$timeSent,$msg[6]);
            array_push($messagesArray, $message);
        }
        return $messagesArray;
    }

}

$msgDao= new MessageDao("fastjobs");
//$state=$msgDao->insertMessage(1,1,"hello",1);
//$state=$msgDao->getMessages(1);
DateTime :$timeSent= new \DateTime("2025-02-05 18:9:57");
$state=$msgDao->getNewMessages(1,$timeSent);
var_dump($state);