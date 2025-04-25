<?php

namespace UnitTest;
use Daos\Dao;
use Daos\MessageDao;
use business\Message;
use DateTime;
use PHPUnit\Framework\TestCase;
require '..\Daos\Dao.php';
require '..\Daos\MessageDao.php';


class MessageDaoTest extends TestCase
{
    private MessageDao $dao;
    private Message $message1;
    private Message $message2;
    private Message $message3;
    protected function setUp():void{
        $this->dao = new MessageDao("fastjobstest");
        $this->message1=new Message();
        $this->message2=new Message();
        $this->message3=new Message();
        $timeSent1= new DateTime("2025-02-05 18:08:57");
        $timeSent2= new DateTime("2025-02-05 18:13:47");
        $timeSent3= new DateTime("2025-02-17 23:56:26");
        $this->message1->message(1,1,1,"hello",1,$timeSent1,false);
        $this->message2->message(2,1,1,"hello",1,$timeSent2,false);
        $this->message3->message(3,1,1,"kkkt",1,$timeSent3,false);
    }
    public function testSendMessage(){
        $expectedMessage=new Message();
        $timeSent=new DateTime();
        $expectedMessage->message(4,1,1,"hello",1,$timeSent,false);
        $actualId=$this->dao->insertMessage(1,1,"hello",1);
        $actualMessage=$this->dao->getMessageById($actualId);
        $expectedMessage->setTimeSent($actualMessage->getTimeSent());
        $this->assertEquals($actualId,$expectedMessage->getMessageId());
        $this->assertEquals($actualMessage,$expectedMessage);
        $this->dao->deletedById("messages","messageId",4);
        $this->dao->updateIncrement("messages",4);
    }
    public function testGetMessageById(){
        $actualMessage=$this->dao->getMessageById(1);
        $this->assertEquals($actualMessage,$this->message1);
    }
    public function testGetMessageById_MessageNotFound(){
        $actualMessage=$this->dao->getMessageById(20);
        $this->assertEquals($actualMessage,null);
    }

    public function testGetMessages(){
        $actualMessages=$this->dao->getMessages(1);
        $expectedMessages=[$this->message3,$this->message2,$this->message1];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetMessages_messagesNotFound(){
        $actualMessages=$this->dao->getMessages(10);
        $expectedMessages=[];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetPreviousMessages(){
        $date= new DateTime("2025-02-05 18:13:47");
       $actualMessages= $this->dao->getPreviousMessages(1,$date);
        $expectedMessages=[$this->message1];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetPreviousMessages_idNotFound(){
        $date= new DateTime("2025-02-05 18:13:47");
        $actualMessages= $this->dao->getPreviousMessages(10,$date);
        $expectedMessages=[];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetPreviousMessages_NoPreviousMessages(){
        $date= new DateTime("2025-02-05 18:08:57");
        $actualMessages= $this->dao->getPreviousMessages(1,$date);
        $expectedMessages=[];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetNewMessages(){
        $date= new DateTime("2025-02-05 18:13:47");
        $actualMessages= $this->dao->getNewMessages(1,$date);
        $expectedMessages=[$this->message3];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetNewMessages_idNotFound(){
        $date= new DateTime("2025-02-05 18:13:47");
        $actualMessages= $this->dao->getNewMessages(10,$date);
        $expectedMessages=[];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetNewMessages_noNewMessages(){
        $date= new DateTime("2025-02-17 23:56:26");
        $actualMessages= $this->dao->getNewMessages(1,$date);
        $expectedMessages=[];
        $this->assertEquals($expectedMessages,$actualMessages);
    }
    public function testGetLastMessage(){
        $actualMessages= $this->dao->getLastMessage(1);
        $this->assertEquals($this->message3,$actualMessages);
    }

}
