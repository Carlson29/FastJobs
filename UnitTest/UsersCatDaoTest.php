<?php

namespace UnitTest;

use business\UsersCategory;
use DateTime;
use PHPUnit\Framework\TestCase;

use Daos\UsersCategoryDao;
require  "..\Daos\Dao.php";
require '..\Daos\UsersCategoryDao.php';
class UsersCatDaoTest extends TestCase
{
    private UsersCategoryDao $dao;
    private UsersCategory $userCategory1;
    protected function setUp(): void{
        $this->dao = new UsersCategoryDao("fastjobstest");
$this->userCategory1 = new UsersCategory();
$this->userCategory1->usersCategory(1,2);
    }
    public function testCreateCategory(){
        $expected=$this->dao->createUserCategory(2,2);
        $this->assertTrue($expected);
        $this->dao->deleteUserCategory(2,2);
    }

    public function testGetUserCategories(){
        $expected=$this->dao->getUserCategories(2);
        $actual=[$this->userCategory1];
            $this->assertEquals($expected,$actual);
    }
    public function testGetUserCategories_WhenNotFound(){
        $expected=$this->dao->getUserCategories(30);
        $actual=[];
        $this->assertEquals($expected,$actual);
    }
    public function testDeleteUserCategory(){
        $this->dao->createUserCategory(2,2);
        $actual=$this->dao->deleteUserCategory(2,2);
        $this->assertTrue($actual);
    }

}
