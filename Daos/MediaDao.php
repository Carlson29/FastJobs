<?php

namespace Daos;
use business\Media;
require '..\business\Media.php';
class MediaDao extends Dao
{
 public function createMedia($postId,$media, $type):bool{
     $query = "INSERT INTO media (postId, media, type) VALUES (:postId, :media, :type) ";
     $statement = $this->getConn()->prepare($query);
     $statement->bindValue(':postId', $postId);
     $statement->bindValue(':media', $media);
     $statement->bindValue(':type', $type);
     try {
         $statement->execute();
         $statement->closeCursor();
         if($statement->rowCount()==1){
             return true;
         }
         // $userId = $this->getConn()->lastInsertId();
     } catch (PDOException $ex) {
         echo "An error occurred in createMedia" . $ex->getMessage();
         return false;
         exit();
     }

     //$statement->closeCursor();
     return false;
 }
    public function getMedia(int $postId):array {
        // $user = new User();
        $query = "SELECT * from media where postId=:postId order by dateTime";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':postId', $postId);
        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo "An error occurred  on getMedia" . $ex->getMessage();
            exit();
        }
        $medias = $statement->fetchAll();
        $statement->closeCursor();
        $mediaArray =[];
        //array_splice($ibpsArray, 0);
        foreach ($medias as $m){
            $media= new Media();
            DateTime: $timePosted= new \DateTime($m[3]);
            $media->media($m[0],$m[1],$m[2],$timePosted);
            array_push($mediaArray, $media);
        }
        return $mediaArray;
    }
}