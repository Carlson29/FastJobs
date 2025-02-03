<?php

use Cassandra\Date;
use Daos\Dao;
require 'Dao.php';
require '..\business\User.php';
class UserDao extends Dao
{
    public function login(string $email, string $password):User{

        $user = new User();
        $query = "Select * from users where email=:email";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':email', $email);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred during login" . $ex->getMessage();
            exit();
        }
        $users = $statement->fetch();
        $statement->closeCursor();
        $dbPass = $users['password'];
        if (!password_verify($password, $dbPass)) {
            $user=null;
            return $user;
        }
        /*$_SESSION['userId'] = $users['adminId'];
        $_SESSION['userType'] = $users['userType'];
        $_SESSION['userName'] = $users['firstName'] . " " . $users['LastName'];*/
        DateTime :$dateOfBirth= new DateTime($users[2]);
        string :$longitude= $users[6].'';
        $latitude= $users[7].'';
        //echo $dateOfBirth;
        $user->user($users[0],$users['1'],$dateOfBirth,$users[3],$users[4],$users[5],$longitude,$latitude,$users[8], $users[9]);
        return $user;
    }

    public function getUserById(int  $id):User{

        $user = new User();
        $query = "Select * from users where id=:id";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':id', $id);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred during login" . $ex->getMessage();
            exit();
        }
        $users = $statement->fetch();
        $statement->closeCursor();
        DateTime :$dateOfBirth= new DateTime($users[2]);
        string :$longitude= $users[6].'';
        $latitude= $users[7].'';

        $user->user($users[0],$users['1'],$dateOfBirth,$users[3],$users[4],$users[5],$longitude,$latitude,$users[8], $users[9]);
        return $user;
    }

public  function register(string $name, DateTime $dateOfBirth, string  $email, string $password, int $userType, string $profilePic, string $searchDiff) :int {

    $password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (name, dateOfBirth, email, password, userType, profilePic, searchDiff) VALUES (:name, :dateOfBirth, :email, :password, :userType, :profilePic, :searchDiff ) ";
    $statement = $this->getConn()->prepare($query);
    $statement->bindValue(':name', $name);
    $dateOfBirth =$dateOfBirth->format('Y-m-d');
    $statement->bindValue(':dateOfBirth', $dateOfBirth);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':userType', $userType);
    $statement->bindValue(':profilePic', $profilePic);
    $statement->bindValue(':searchDiff', $searchDiff);
    try {
        $statement->execute();
        $userId = $this->getConn()->lastInsertId();
    } catch (PDOException $ex) {
        echo "An error occurred in register" . $ex->getMessage();
        return -1;
        exit();
    }

    $statement->closeCursor();
    return $userId;
}
    public  function updateUser(string $name, DateTime $dateOfBirth, string  $email, string $newPassword, int $userType, string $profilePic, string $searchDiff, string $oldPassword):User {

        $user=$this->login($email,$oldPassword);
        if($user!=null) {
            $password = password_hash($newPassword, PASSWORD_BCRYPT);

            $query = "Update users INSERT INTO (name, dateOfBirth, email, password, userType, profilePic, searchDiff) VALUES (:name, :dateOfBirth, :email, :password, :userType, :profilePic, :searchDiff ) where email=:email2 ";
            $statement = $this->getConn()->prepare($query);
            $statement->bindValue(':name', $name);
            $dateOfBirth = $dateOfBirth->format('Y-m-d');
            $statement->bindValue(':dateOfBirth', $dateOfBirth);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':userType', $userType);
            $statement->bindValue(':profilePic', $profilePic);
            $statement->bindValue(':searchDiff', $searchDiff);
            $statement->bindValue(':email2', $email);
            try {
                $statement->execute();
                $userId = $this->getConn()->lastInsertId();
            } catch (PDOException $ex) {
                echo "An error occurred in register" . $ex->getMessage();
                exit();
            }

            $statement->closeCursor();
            return $userId;
        }
        return $user;
    }


}


//require 'Dao.php';
/*$dao=new Dao("gossip");
$db=$dao -> getConn();
function getUserLastName($userId,$db) {
    global $db;

    $query = "select userName from users where userId=:userId";
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    try {
        $statement->execute();
    } catch (PDOException $ex) {
        //ECHO "Connection Failure Error is " . $ex->getMesssage();
        //redirect to an error page passing the error message
        header("Location:../view/error.php?msg=" . $ex->getMessage());
        exit();
    }

    $name = $statement->fetch();
    $statement->closeCursor();
    return $name[0];
}


$lastName=getUserLastName(1, $db);*/
$userDao= new UserDao("fastJobs");
DateTime :$dateOfBirth= new DateTime("2013-03-15");
$id=$userDao->register('carlson',$dateOfBirth,'carl@gmail','123', 1, 'picture', 'u'  );
//$id=$userDao->login('carl@gmail', '123');
//$currentDate =$id->getDateOfBirth()->format('Y-m-d');
//$dateOfBirth=$userDao->
//echo $currentDate;
echo $id;