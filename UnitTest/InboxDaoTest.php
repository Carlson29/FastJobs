<?php

namespace UnitTest;

use Daos\InboxDao;
use PHPUnit\Framework\TestCase;
use business\Inbox;
require '..\Daos\Dao.php';
require  "..\Daos\InboxDao.php";
class InboxDaoTest extends TestCase
{
    private InboxDao $Dao;
    private Inbox $inbox1;

    protected function setUp():void{
        $this->Dao=new InboxDao("fastjobstest");
        $this->inbox1 = new Inbox();
        $this->inbox1->inbox(1,1,-1,"");
    }
    public function testCreateInbox(){
        $expectedInbox = new Inbox();
        $expectedInbox->inbox(3,1,-1,"");
       $actualId= $this->Dao->createInbox(1,-1,"");
       $expectedId= 3;
       $this->assertEquals($expectedId, $actualId);
       $actualInbox=$this->Dao->getInbox($actualId);
       $this->assertEquals($expectedInbox, $actualInbox);
       $this->Dao->deletedById("inbox","inboxId",$actualId);
$this->Dao->updateIncrement("inbox",$actualId);
    }
    public function testGetInbox(){
      $actualInbox=  $this->Dao->getInbox(1);
      $this->assertEquals($actualInbox, $this->inbox1);
    }

    public function testGetInbox_WhenNotFound(){
        $actualInbox=  $this->Dao->getInbox(20);
        $this->assertNull($actualInbox);
    }

}
