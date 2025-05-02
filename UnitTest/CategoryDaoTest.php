<?php

namespace UnitTest;
use Daos\Dao;
use Daos\CategoryDao;
use PHPUnit\Framework\TestCase;
use business\Category;
require '..\Daos\Dao.php';
require  '..\Daos\CategoryDao.php';

class CategoryDaoTest extends TestCase
{
    private CategoryDao $dao;
    private Category $category1;

    protected function setUp(): void{
        $this->dao = new CategoryDao("fastjobstest");
        $this->category1 = new Category();
        $this->category1->category(1,"carpenter","c");
    }

    public function testCreateCategory(){
        $expectedCategory = new Category();
        $expectedCategory->category(3,"Technician","c");
        $actualId=  $this->dao->createCategory("Technician");
        $expectedId=3;
        $this->assertEquals($expectedId, $actualId);
        $actualCategory=$this->dao->getCategory($actualId);
        $this->assertEquals($expectedCategory, $actualCategory);
        $this->dao->deletedById("categories","categoryId",$actualId);
        $this->dao->updateIncrement("categories",3);

    }

    public function testGetCategory(){
$actualCategory=$this->dao->getCategory(1);
$this->assertEquals($this->category1, $actualCategory);
    }
    public function testGetCategory_WhenNotFound(){
        $actualCategory=$this->dao->getCategory(20);
        $this->assertNull( $actualCategory);
    }


}
