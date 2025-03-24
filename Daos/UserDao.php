<?php

use Cassandra\Date;
use Daos\Dao;

require 'Dao.php';
require '..\business\User.php';

class UserDao extends Dao
{
    public function getUserById(int $id): ?User
    {

        $user = new User();
        $query = "Select * from users where userId=:id";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':id', $id);
        try {
            $statement->execute();
            $users = $statement->fetch();
            $statement->closeCursor();
            if ($users != null) {
                DateTime :
                $dateOfBirth = new DateTime($users[2]);
                $dateJoint = new DateTime($users[10]);
                string :
                $longitude = $users[6] . '';
                $latitude = $users[7] . '';
                $profilePic = $users[8] . '';
                $user->user($users[0], $users[1], $dateOfBirth, $users[3], $users[4], $users[5], $longitude, $latitude, $profilePic, $users[9], $dateJoint);
            } else {
                $user = null;
            }
        } catch (PDOException $ex) {
            echo "An error occurred during login" . $ex->getMessage();
            exit();
        }

        return $user;
    }

    public function checkEmail(string $email): bool
    {


        $query = "Select * from users where email=:email ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':email', $email);
        try {
            $statement->execute();
            $statement->closeCursor();
            if ($statement->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $ex) {
            echo "An error occurred during login" . $ex->getMessage();
            exit();
        }

        return true;
    }

    public function getFirstUser(): ?User
    {

        $u = new User();
        $query = "Select * from users where userId=(Select MIN(userId) from users)";
        $statement = $this->getConn()->prepare($query);
        try {
            $statement->execute();
            $users = $statement->fetch();
            $statement->closeCursor();
            if ($users != null) {
                DateTime :
                $dateOfBirth = new DateTime($users[2]);
                $dateJoint = new DateTime($users[10]);
                string :
                $longitude = $users[6] . '';
                $latitude = $users[7] . '';
                $profilePic = $users[8] . '';
                $u->user($users[0], $users[1], $dateOfBirth, $users[3], $users[4], $users[5], $longitude, $latitude, $profilePic, $users[9], $dateJoint);
                return $u;
            }

        } catch (PDOException $ex) {
            echo "An error occurred during getFirstUser" . $ex->getMessage();
            exit();
        }
        return $u;
    }

    public function getUsers(DateTime $dateJoint, int $count, bool $firstLoop): array
    {
        $u = new User();
        $query = "";
        if ($firstLoop == true) {
            $query = "Select * from users where dateJoint >=:dateJoint order by dateJoint ASC limit " . " " . $count;
        } else {
            $query = "Select * from users where dateJoint >:dateJoint order by dateJoint ASC limit " . " " . $count;
        }
        $statement = $this->getConn()->prepare($query);
        $dateJoint = $dateJoint->format('Y-m-d H:i:s');
        $statement->bindValue(':dateJoint', $dateJoint);
        try {
            $statement->execute();
            $users = $statement->fetchAll();
            $statement->closeCursor();
            $allUsers = [];
            foreach ($users as $user) {
                DateTime :
                $dateOfBirth = new DateTime($user[2]);
                $dateJoint = new DateTime($user[10]);
                string :
                $longitude = $user[6] . '';
                $latitude = $user[7] . '';
                $profilePic = $user[8] . '';
                $u = new User();
                $u->user($user[0], $user[1], $dateOfBirth, $user[3], $user[4], $user[5], $longitude, $latitude, $profilePic, $user[9], $dateJoint);
                array_push($allUsers, $u);
            }
            return $allUsers;

        } catch (PDOException $ex) {
            echo "An error occurred during getUsers" . $ex->getMessage();
            exit();
        }
        return $allUsers;
    }

    public function register(string $name, DateTime $dateOfBirth, string $email, string $password, int $userType, string $profilePic, string $searchDiff): int
    {

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, dateOfBirth, email, password, userType, profilePic, searchDiff) VALUES (:name, :dateOfBirth, :email, :password, :userType, :profilePic, :searchDiff ) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':name', $name);
        $dateOfBirth = $dateOfBirth->format('Y-m-d');
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

    public function updateUser(string $name, DateTime $dateOfBirth, string $email, string $oldPassword, int $userType, string $profilePic, string $searchDiff, string $newPassword): bool
    {

        $user = $this->login($email, $oldPassword);
        if ($user != null) {
            string :
            $password = null;
            if ($newPassword != null) {
                $password = password_hash($newPassword, PASSWORD_BCRYPT);
            } else {
                $password = password_hash($oldPassword, PASSWORD_BCRYPT);
            }
            $query = "Update users set name=:name, dateOfBirth=:dateOfBirth, email=:email, password=:password, userType=:userType, profilePic=:profilePic, searchDiff=:searchDiff where email=:email2 ";
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
                //$userId = $this->getConn()->lastInsertId();
                $statement->closeCursor();
                if ($statement->rowCount() == 1) {
                    return true;
                }
            } catch (PDOException $ex) {
                echo "An error occurred in register" . $ex->getMessage();
                exit();
            }

            //$statement->closeCursor();

        }
        return false;
    }

    public function login(string $email, string $password): ?User
    {

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
        if ($statement->rowCount() == 1) {
            $dbPass = $users['password'];
            if (password_verify($password, $dbPass) == true) {
                DateTime :
                $dateOfBirth = new DateTime($users[2]);
                $dateJoint = new DateTime($users[10]);
                string :
                $longitude = $users[6] . '';
                $latitude = $users[7] . '';
                $user->user($users[0], $users[1], $dateOfBirth, $users[3], $users[4], $users[5], $longitude, $latitude, $users[8] . "", $users[9], $dateJoint);
                return $user;
            } else {
                $user = null;
                return $user;
            }
        } else {
            $user = null;
            return $user;
        }
        /*$_SESSION['userId'] = $users['adminId'];
        $_SESSION['userType'] = $users['userType'];
        $_SESSION['userName'] = $users['firstName'] . " " . $users['LastName'];*/
        return $user;
    }

    public function updateLocation(string $longitude, string $latitude, int $id): bool
    {


        $query = "Update users set longitude=:longitude, latitude=:latitude where userId=:id ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':longitude', $longitude);
        $statement->bindValue(':latitude', $latitude);
        $statement->bindValue(':id', $id);
        try {
            $statement->execute();
            //$userId = $this->getConn()->lastInsertId();
            $statement->closeCursor();
            if ($statement->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $ex) {
            echo "An error occurred in updateLocation" . $ex->getMessage();
            exit();
        }

        //$statement->closeCursor();


        return false;
    }

    function searchWorkers(String $input):array
    {
        $query = "SELECT users.userId, users.name, users.searchDiff from users where name like :input1 and userType=2 UNION SELECT categories.categoryId, categories.categoryName, categories.searchDiff FROM categories where categories.categoryName like :input2 LIMIT 10";

        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':input1', '%'.$input.'%');
        $statement->bindValue(':input2', '%'.$input.'%');
        try {
            $statement->execute();
            $cats = $statement->fetchAll();
            $statement->closeCursor();
            $allCats = [];
            foreach ($cats as $cat) {
             $c =[];
             $c[0]=$cat[0];
             $c[1]=$cat[1];
             $c[2]=$cat[2];
             array_push($allCats, $c);
            }
            return $allCats;

        } catch (PDOException $ex) {
            echo "An error occurred during searchWorkers" . $ex->getMessage();
            exit();
        }
        return $allCats;
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
//$userDao = new UserDao("fastjobs");
//DateTime:
//$dateOfBirth = new DateTime("2025-02-15 15:03:02");
//$id = $userDao->getUsers($dateOfBirth, 20, true);
//$id=$userDao->register('carlson',$dateOfBirth,'carl@gmail.com','123', 1, 'picture', 'u'  );
//$id=$userDao->login('carl@gmail.com', '123');
//$id=$userDao->login('carl@gmail', '123');
//$id=$userDao->login('carl@gmail', '123');
//string :$newPassword= null."";
//$id=$userDao->updateUser('carlson',$dateOfBirth,'carl@gmail','1234', 1, 'picture2', 'u',$newPassword );
//$id=$userDao->updateLocation("122","2343", 4);
//$currentDate =$id->getDateOfBirth()->format('Y-m-d');
//$dateOfBirth=$userDao->
//echo $id;
//$id=$userDao->checkEmail("angel@gmail.com");
//var_dump($id);