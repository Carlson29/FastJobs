<?php

namespace UnitTest;

use Daos\Dao;
use Daos\InboxParticipantsDao;
use PHPUnit\Framework\TestCase;
use business\InboxParticipant;
use DateTime;
require '..\Daos\Dao.php';
require '..\Daos\InboxParticipantsDao.php';

class InboxParticipantsDaoTest extends TestCase
{
    private Dao $dao;
    private InboxParticipant $ibp1;
    private InboxParticipant $ibp2;
    public function setUp():void{
        $this->dao = new InboxParticipantsDao("fastjobstest");
        $this->ibp1 = new InboxParticipant();
        $this->ibp2 = new InboxParticipant();
        $lastSent1= new DateTime("2025-04-04 21:14:01");
        $lastSent2= new DateTime("2025-04-04 21:14:01");
        $this->ibp1->inboxParticipant(1,1,false,0,false,$lastSent1);
        $this->ibp2->inboxParticipant(3,1,false,0,false,$lastSent2);
    }

    public function testInsertInboxParticipant(){
    $actual=$this->dao->insertInboxParticipants(1,2,false,0,false);
    $this->assertTrue($actual);
    $ibp=$this->dao->getIbp(2,1);
    $this->assertEquals(1,$ibp->getUserId());
    $this->assertEquals(2,$ibp->getInboxId());
    $this->dao->deleteIbp(1,2);

    }

    public function testUpdateLastSent(){
        $ibps=$this->dao->getInboxParticipantsByInboxId(1);
        $lastSent= new DateTime();
        $actual=$this->dao->updateLastSent(1,$lastSent);
        $this->assertTrue($actual);
       $this->dao->updateLastSent(1,$ibps[0]->getLastSent());
    }
    public function testUpdateLastSent_WhenIbpNotFound(){
        $lastSent= new DateTime();
        $actual=$this->dao->updateLastSent(10,$lastSent);
        $this->assertFalse($actual);
    }
    public function testGetInboxParticipants(){
        $actual=$this->dao->getInboxParticipants(1);
        $expected= [$this->ibp1];
        $this->assertEquals($expected, $actual);
    }

    public function testGetInboxParticipants_WhenIbpNotFound(){
        $actual=$this->dao->getInboxParticipants(10);
        $expected= [];
        $this->assertEquals($expected, $actual);
    }
    public function testGetInboxParticipantsByInboxId(){
        $actual=$this->dao->getInboxParticipantsByInboxId(1);
        $expected= [$this->ibp1,$this->ibp2];
        $this->assertEquals($expected, $actual);
    }
    public function testGetInboxParticipantsByInboxId_WhenIbpsNotFound(){
        $actual=$this->dao->getInboxParticipantsByInboxId(10);
        $expected= [];
        $this->assertEquals($expected, $actual);
    }
    public function testGetOtherIbp(){
        $actual=$this->dao->getOtherIbp(1,1);
        $expected=$this->ibp2;
        $this->assertEquals($expected, $actual);
    }
    public function testGetOtherIbp_WithInvalidInboxIdAndUserId(){
        $actual=$this->dao->getOtherIbp(10,10);
        $this->assertNull( $actual);
    }
    public function testGetIbp(){
        $actual=$this->dao->getIbp(1,1);
        $this->assertEquals( $actual,$this->ibp1);
    }
    public function testGetIbp_InvalidDetails(){
        $actual=$this->dao->getIbp(10,0);
        $this->assertNull( $actual);
    }
    public function testUpdateUnseenMessages_SetToZero(){
        $this->dao->updateUnseenMessages(3,1,1);
        $actual=$this->dao->updateUnseenMessages(1,1,0);
        $this->assertTrue($actual);
        $ibp=$this->dao->getIbp(1,1);
        $this->assertEquals($ibp->getUnSeenMessages(),0);
    }

    public function testUpdateUnseenMessages_setToNumBiggerThanZero(){
        $actual= $this->dao->updateUnseenMessages(3,1,1);
        $this->assertTrue($actual);
        $ibp=$this->dao->getIbp(1,1);
        $this->assertEquals($ibp->getUnSeenMessages(),1);
        $this->dao->updateUnseenMessages(1,1,0);
    }
    public function testUpdateUnseenMessages_InvalidDetails(){
        $actual= $this->dao->updateUnseenMessages(10,10,1);
        $this->assertFalse($actual);}
    public function testUpdateIsOpen(){
        $actual= $this->dao->updateIsOpen(1,1,true);
        $this->assertTrue($actual);
        $ibp=$this->dao->getIbp(1,1);
        $this->assertTrue($ibp->IsOpen());
        $this->dao->updateIsOpen(1,1,false);
    }
    public function testUpdateIsOpen_InvalidDetails(){
        $actual= $this->dao->updateIsOpen(10,10,true);
        $this->assertFalse($actual);
    }
    public function testDeleteIbp(){
        $this->dao->insertInboxParticipants(1,2,false,0,false);
        $actual=$this->dao->deleteIbp(1,2);
        $this->assertTrue($actual);
        $ibp=$this->dao->getIbp(2,1);
        $this->assertNull( $ibp);
    }
    public function testDeleteIbp_DeleteInvalidIbp(){
        $actual=$this->dao->deleteIbp(10,10);
        $this->assertFalse($actual);
        $ibp=$this->dao->getIbp(10,10);
        $this->assertNull( $ibp);
    }

}
