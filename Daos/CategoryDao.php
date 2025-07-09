<?php

namespace Daos;
use PDOException;
use business\Category;

require '..\business\Category.php';
class CategoryDao extends Dao
{

    public function createCategory(string $categoryName):int
    {
            $query = "INSERT INTO categories (categoryName) VALUES (:categoryName) ";
            $statement = $this->getConn()->prepare($query);
            $statement->bindValue(':categoryName', $categoryName);
            try {
                $statement->execute();
                $id = $this->getConn()->lastInsertId();
                $statement->closeCursor();
                if($statement->rowCount()==1){
                    return $id;
                }
                // $userId = $this->getConn()->lastInsertId();
            } catch (PDOException $ex) {
                echo "An error occurred in createCategory" . $ex->getMessage();
                return -1;
                exit();
            }

            //$statement->closeCursor();
            return -1;
    }
    function getCategory(int $categoryId):?Category{
        $category = new Category();
        $query = "Select * from categories where categoryId=:categoryId";
        $statement = $this->getConn()->prepare($query);
        $statement->bindValue(':categoryId', $categoryId);
        try {
            $statement->execute();
            $cat = $statement->fetch();
            $statement->closeCursor();
            if($cat!=null){
                $category->category($cat[0],$cat[1],$cat[2]);
            }
            else {
                $category= null;
            }
        } catch (PDOException $ex) {
            echo "An error occurred during getCategory" . $ex->getMessage();
            exit();
        }
        return $category;
    }


}

/*$dao=new CategoryDao("fastjobs");
//$id=$dao->createCategory("carpenter");
$id=$dao->getCategory(1);
echo $id;*/