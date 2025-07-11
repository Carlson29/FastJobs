<?php

namespace Daos;

 use PDO;
 use PDOException;

 class Dao
{
 private  PDO  $conn;
 private string $dbName;

    public function __construct(string $dbName)
    {
        $this->dbName=$dbName;
    }

    public function setConnection(PDO $connection){
        $this->conn=$connection;
    }

     public function getConn(): PDO
     {
         if(isset($this->conn)){
             return $this->conn;
         }
         else {
             $_SERVER['HTTP_HOST'] = "localhost";
             if($_SERVER['HTTP_HOST'] == "localhost"){
                 $dsn = "mysql:host=localhost;dbname=". $this->dbName;
                 $username = "root";
                 $password = "";
             }
             else{
                 //online
                 $hostname="mysql06host.comp.dkit.ie";
                 $dbname= "D00243400";
                 $username = "D00243400";
                 $password = "Dh17CZtF";

                 $dsn = "mysql:host=" . $hostname . ";dbname=" . $dbname;
             }

             try{
                 $db = new PDO($dsn, $username, $password);
                 //set up error reporting on server
                 $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $this->conn =$db;
                 error_reporting(E_ALL);

             } catch (PDOException $ex) {
                 //ECHO "Connection Failure Error is " . $ex->getMesssage();
                 //redirect to an error page passing the error message
                 header("Location:../view/error.php?msg=" . $ex->getMessage());
             }

         }

         return $this->conn;
     }


     public function updateIncrement( string $table, int $increment){
         $query = "ALTER TABLE " . $table . " AUTO_INCREMENT ". $increment;
         $statement = $this->getConn()->prepare($query);
        // $statement->bindValue(':increment', $increment);
         try {
             $statement->execute();
             $statement->closeCursor();
         } catch (PDOException $ex) {
             echo "An error occurred in updateIncrement" . $ex->getMessage();
             exit();
         }

         //$statement->closeCursor();
     }
     public function deletedById( string $table, string $columnName, int $id):bool{
         $query = "delete from " . $table . " where ". $columnName . "=:id";
         $statement = $this->getConn()->prepare($query);
         $statement->bindValue(':id', $id);
         try {
             $statement->execute();
             $statement->closeCursor();
             if ($statement->rowCount() == 1) {
                 return true;
             }
         } catch (PDOException $ex) {
             echo "An error occurred in updateIncrement" . $ex->getMessage();
             exit();
         }
         return false;

         //$statement->closeCursor();
     }

}