<?php

namespace Daos;
use business\Inbox;

require '..\business\Inbox.php';
class InboxDao extends Dao
{

    function createInbox(int $inboxType, int $adminId, string $groupName):int{
        $query = "INSERT INTO inbox (inboxType, adminId, groupName) VALUES (:inboxType, :adminId, :groupName) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxType', $inboxType);
        $statement->bindValue(':adminId', $adminId);
        $statement->bindValue(':groupName', $groupName);
        try {
            $statement->execute();
            $id = $this->getConn()->lastInsertId();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return $id;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in createInbox" . $ex->getMessage();
            return -1;
            exit();
        }

        //$statement->closeCursor();
        return -1;
    }

    function getInbox(int $inboxId):?Inbox{
        $inbox = new Inbox();
        $query = "Select * from inbox where inboxId=:inboxId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':inboxId', $inboxId);
        try {
            $statement->execute();
            $i = $statement->fetch();
            $statement->closeCursor();
            if($i!=null){
                $inbox->inbox($i[0],$i[1],$i[2],$i[3]);
            }
            else {
                $inbox= null;
            }
        } catch (PDOException $ex) {
            echo "An error occurred during getInbox" . $ex->getMessage();
            exit();
        }
        return $inbox;
    }




}

//$d= new InboxDao("fastjobs");
//$state=$d->createInbox(1,-1,"");
//$state=$d->getInbox(1);
//echo $state;