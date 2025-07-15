<?php

namespace Daos;
use business\Post;
use PDOException;
//require 'Dao.php';
require '..\business\Post.php';
class PostDao extends Dao
{
    function createPost(int $userId, int $userType, string $about):int{
        $query = "INSERT INTO post (userId, userType, about) VALUES (:userId, :userType, :about) ";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':userType', $userType);
        $statement->bindValue(':about', $about."");
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
    public function getPost(\DateTime $dateTime, int $max,bool $firstLoop):array {
        $query ="";
        if($firstLoop){
            $query = "SELECT * from post where dateTime>=:dateTime order by dateTime ASC limit " . $max;
        } else{
            $query = "SELECT * from post where dateTime>:dateTime order by dateTime ASC limit " . $max;
        }
        $statement = $this->getConn()->prepare($query);
        $dateTime =$dateTime->format('Y-m-d H:i:s');
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
/*$p=new postDao("fastjobs");
$id=$p->createPost(1,2);
echo $id;*/
//$p->getPost()
