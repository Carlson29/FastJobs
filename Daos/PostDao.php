<?php

namespace Daos;
use business\Post;
use PDOException;

require '..\business\Post.php';
class PostDao extends Dao
{
    function createPost(int $userId, int $userType):int{
        $query = "INSERT INTO post (userId, userType) VALUES (:userId, :userType) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':userType', $userType);
        try {
            $statement->execute();
            $id = $this->getConn()->lastInsertId();
            $statement->closeCursor();
            if($statement->rowCount()==1){
                return $id;
            }
            // $userId = $this->getConn()->lastInsertId();
        } catch (PDOException $ex) {
            echo "An error occurred in createPost" . $ex->getMessage();
            return -1;
            exit();
        }

        //$statement->closeCursor();
        return -1;
    }

    public function getPostByUserId(int $userId):array {
        // $user = new User();
        $query = "SELECT * from post where userId=:userId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getPostByUserId" . $ex->getMessage();
            exit();
        }
        $posts = $statement->fetchAll();
        $statement->closeCursor();
        $postArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($posts as $p){
            $post= new Post();
            DateTime: $timePosted= new \DateTime($p[2]);
           $post->post($p[0],$p[1],$timePosted,$p[3],$p[4]);
            array_push($postArray, $post);
        }
        return $postArray;
    }
    public function getPost(int $dateTime, bool $firstLoop):array {
        // $user = new User();
        $query = "SELECT * from post where dateTime>=:dateTime order by dateTime ASC limit 10";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':dateTime', $dateTime);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getPost" . $ex->getMessage();
            exit();
        }
        $posts = $statement->fetchAll();
        $statement->closeCursor();
        $postArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($posts as $p){
            $post= new Post();
            DateTime: $timePosted= new \DateTime($p[2]);
            $post->post($p[0],$p[1],$timePosted,$p[3],$p[4]);
            array_push($postArray, $post);
        }
        return $postArray;
    }
}