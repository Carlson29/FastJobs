<?php

namespace Daos;
//use 'business\InboxParticipant.php';
use Daos\Dao;
use InboxParticipant;

require 'Dao.php';
require '..\business\InboxParticipant.php';
require '..\business\User.php';


class InboxParticipantsDao extends Dao
{

    public function insertInboxParticipants(int $userId,int $inboxId, bool $deletedState, int $unseenMessages, bool $isOpen):bool
    {
        $query = "INSERT INTO inboxparticipants (userId, inboxId, deletedState, unseenMessages, isOpen) VALUES (:userId, :inboxId, :deletedState, :unseenMessages, :isOpen) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':inboxId', $inboxId);
        $statement->bindValue(':deletedState', $deletedState);
        $statement->bindValue(':unseenMessages', $unseenMessages);
        $statement->bindValue(':isOpen', $isOpen);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
           // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in register" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }

    public function getInboxParticipants(int $userId):array {
       // $user = new User();
        $query = "Select * from inboxparticipants where userId=:userId and deletedState=false order by lastSent DESC ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getInboxParticipants" . $ex->getMessage();
            exit();
        }
        $ibps = $statement->fetchAll();
        $ibpsArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($ibps as $ibp){
            $Ibp= new InboxParticipant();
            $Ibp->inboxParticipant($ibp[0],$ibp[1],$ibp[2],$ibp[3],$ibp[4]);
            //$ibpsArray =$Ibp;
            array_push($ibpsArray, $Ibp);
        }
        return $ibpsArray;
    }

    public function updateUnseenMessages(int $userId,int $inboxId, int $unseenMessages):bool
    {
        if($unseenMessages==0){
            $query = "Update inboxparticipants set unseenMessages=0 where userId=:userId and inboxId=:inboxId";
        }
        else{
            $query = "Update inboxparticipants set unseenMessages=unseenMessages+1 where userId=:userId and inboxId=:inboxId";
        }
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':inboxId', $inboxId);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in updateUnseenMessages" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }
    public function updateIsOpen(int $userId,int $inboxId, bool $isOpen):bool
    {
        $query = "Update inboxparticipants set isOpen=:isOpen where userId=:userId and inboxId=:inboxId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':inboxId', $inboxId);
        $statement->bindValue(':isOpen', $isOpen);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in updateIsOpen" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }


}
$ibpDao = new InboxParticipantsDao("fastjobs");
//$state=$ibpDao->insertInboxParticipants(1,1,false,0,false);
//$state=$ibpDao->getInboxParticipants(1);

//$state=$ibpDao->updateIsOpen(1,1,false);
$state=$ibpDao->updateUnseenMessages(1,1,0);
var_dump($state);