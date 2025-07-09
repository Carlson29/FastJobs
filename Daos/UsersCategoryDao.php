<?php

namespace Daos;
//require 'Dao.php';
use business\UsersCategory;
use PDOException;
require '..\business\UsersCategory.php';

class UsersCategoryDao extends Dao
{

    public function createUserCategory(int $categoryId, int $userId):bool
    {
        $query = "INSERT INTO userscategory (categoryId, userId) VALUES (:categoryId, :userId) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->bindValue(':userId', $userId);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in createCategory" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }
    public function getUserCategories(int $userId):array {

        $query = "Select * from userscategory where userId=:userId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getInboxParticipants" . $ex->getMessage();
            exit();
        }
        $ucs = $statement->fetchAll();
        $statement->closeCursor();
        $userCats =[];
        foreach ($ucs as $uc){
            $cat= new UsersCategory();
            $cat->usersCategory($uc[0],$uc[1]);

            array_push($userCats, $cat);
        }
        return $userCats;
    }

    public function deleteUserCategory(int $userId,int $catId):bool
    {
        $query = "Delete from userscategory where userId=:userId and categoryId=:catId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':catId', $catId);
        try {
            $statement->execute();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return true;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in deleteUserCategory" . $ex->getMessage();
            return false;
            exit();
        }

        //$statement->closeCursor();
        return false;
    }
}
//$dao=new UsersCategoryDao("fastjobs");
//$id=$dao->createUserCategory(1,1);
//$id=$dao->getUserCategories(1);
//var_dump($id);