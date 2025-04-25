<?php

namespace UnitTest;
use business\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Daos\Dao;
use Daos\UserDao;
require '..\Daos\Dao.php';
require  "..\Daos\UserDao.php";

class UserDaoTest extends TestCase
{
    protected UserDao $dao;
    protected User $user1;
    protected User $user2;

    protected function setUp(): void
    {
        parent::setUp();
      $this->dao = new UserDao("fastjobstest");
      $this->user1=new User();
        $this->user2=new User();
        $dateOfBirth1=new DateTime("2003-08-20");
        $dateOfBirth2=new DateTime("1990-10-16");
        $dateJoint1=new DateTime("2025-02-15 15:03:02");
        $dateJoint2=new DateTime("2025-02-17 23:05:27");
      $this->user1->user(1,"carlson",$dateOfBirth1,"carl@gmail.com","",1,"","","","u",$dateJoint1);
        $this->user2->user(2,"Jhon",$dateOfBirth2,"jhon@gmail.com","",2,"","","","u",$dateJoint2);
    }

    public function testRegisterUser(){
       $dateOfBirth=new DateTime("2003-08-20");
        $name="Jessica";
        $password="123456";
        $email="jessica@gmail.com";
        $searchDiff="u";
        $profilePic="";
        $expectedUser=new User();
      $actualId=  $this->dao->register($name,$dateOfBirth,$email,$password,1,$profilePic,$searchDiff);
      $expectedId=4;
      $actualUser=$this->dao->getUserById($actualId);
        $expectedUser->user(4,$name,$dateOfBirth,$email,$password,1,"","","",$searchDiff,$actualUser->getDateJoint());
        $this->assertEquals($expectedUser->getId(),$actualUser->getId());
        $this->dao->deleteUser($actualId);
        $this->dao->updateIncrement("users",$actualId);
      $this->assertEquals($expectedId, $actualId);
    }

    public function testGetUser(){
      $actualUser= $this->dao->getUserById(1);
      $this->assertEquals($actualUser->getId(), $this->user1->getId());
    }

    public function testGetUser_userNotFound(){
        $actualUser= $this->dao->getUserById(50);
        $this->assertEquals($actualUser, null);
    }
    public function testCheckEmail(){
        $actual= $this->dao->checkEmail("jhon@gmail.com");
        $this->assertEquals($actual, true);
    }
    public function testCheckEmail_EmailNotFound(){
        $actual= $this->dao->checkEmail("anthony@gmail.com");
        $this->assertEquals($actual, false);
    }
    public function testDeleteUser(){
        $dateOfBirth=new DateTime();
        $name="Jessica";
        $password="123456";
        $email="jessica@gmail.com";
        $searchDiff="u";
        $profilePic="";
        $actualId=  $this->dao->register($name,$dateOfBirth,$email,$password,1,$profilePic,$searchDiff);
        $actual=$this->dao->deleteUser($actualId);
        $this->assertEquals($actual, true);
        $this->dao->updateIncrement("users",$actualId);
    }

    public function testDeleteUser_userNotFound(){
        $actual=$this->dao->deleteUser(40);
        $this->assertEquals($actual, false);
    }

    public function testGetFirstUser(){
        $actualUser=$this->dao->getFirstUser();
        $this->assertEquals($actualUser->getId(), $this->user1->getId());
    }
    public function testGetUsers(){
        $dateJoint1=new DateTime("2025-02-15 15:03:02");
        $actualUsers=$this->dao->getUsers($dateJoint1,2,true,20);
        $expectedUsers=[$this->user1,$this->user2];
        $expectedUsers = array_map(fn($user) => $user->getId(), $expectedUsers);
        $actualUsers = array_map(fn($user) => $user->getId(), $actualUsers);
        $this->assertEquals($actualUsers, $expectedUsers);
    }
    public function testGetUsers_notFirstLoop(){
        $dateJoint1=new DateTime("2025-02-15 15:03:02");
        $actualUsers=$this->dao->getUsers($dateJoint1,1,false,20);
        $expectedUsers=[$this->user2];
        $this->assertEquals($actualUsers, $expectedUsers);
    }
    /*$actualSubset = array_map(fn($user) => [
    'id' => $user->id,
    'name' => $user->name
], $users);*/

    public function testGetUsersByCategory(){
        $dateJoint1=new DateTime("2025-02-15 15:03:02");
        $actualUsers=$this->dao->getUsersByCategory($dateJoint1,2,true,20,1);
        $expectedUsers=[$this->user2];
        $actualUsers = array_map(fn($user) => $user->getId(), $actualUsers);
        $expectedUsers = array_map(fn($user) => $user->getId(), $expectedUsers);
        $this->assertEquals($actualUsers, $expectedUsers);
    }
    public function testGetUsersByCategory_notFirstLoop(){
        $dateJoint1=new DateTime("2025-02-15 15:03:02");
        $actualUsers=$this->dao->getUsersByCategory($dateJoint1,2,false,20,1);
        $expectedUsers=[$this->user2];
        $actualUsers = array_map(fn($user) => $user->getId(), $actualUsers);
        $expectedUsers = array_map(fn($user) => $user->getId(), $expectedUsers);
        $this->assertEquals($actualUsers, $expectedUsers);
    }
    public function testLogin(){
       $user= $this->dao->login("carl@gmail.com","123");
       $this->assertEquals($user->getId(), $this->user1->getId());
    }
    public function testLogin_wrongPassword(){
        $user= $this->dao->login("carl@gmail.com","321");
        $this->assertEquals($user, null);
    }
    public function testLogin_wrongEmail(){
        $user= $this->dao->login("carl123@gmail.com","123");
        $this->assertEquals($user, null);
    }
    public function testUpdateLocation(){
        $actual=$this->dao->updateLocation("-66","55",1);
        $user=$this->dao->getUserById(1);
        $this->assertEquals($user->getLongitude(),"-66");
        $this->assertEquals($user->getLatitude(),"55");
        $this->assertEquals($actual, true);
        $this->dao->updateLocation("","",1);
    }
    public function testUpdateLocation_whenIdNotFound(){
        $actual=$this->dao->updateLocation("-66","55",10);
        $this->assertEquals($actual, false);
    }

}
