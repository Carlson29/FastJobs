<?php

use Daos\InboxParticipantsDao;
use Daos\MessageDao;

session_start();
//use UserDao;
//require '..\Daos\Dao.php';
//require '..\business\User.php';
require '..\Daos\UserDao.php';
require '..\Daos\MessageDao.php';
require '..\Daos\InboxParticipantsDao.php';


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = "";
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
if ($action == NULL && $user != NULL) {
    $action = 'show_signup';
} elseif ($action == NULL && $user == NULL) {
    $action = 'show_signup';
}
switch ($action) {
    case "show_signup":
        $pageTitle='SignUp Page';
        include "../view/signUp.php";
        break;
    case "do_signup":
        $userDao = new UserDao("fastjobs");
        $userName = filter_input(INPUT_POST, "userName", FILTER_UNSAFE_RAW);
        $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
        $dateOfBirth = filter_input(INPUT_POST, "dateOfBirth", FILTER_UNSAFE_RAW);
        if ($userDao->checkEmail($email) == false) {
            if (isset($_POST['worker'])) {
                $dateOfBirth = new DateTime($dateOfBirth);
                $id = $userDao->register($userName, $dateOfBirth, $email, $password, 2, "", "u");
                // echo "helloo" . $id;
            } else if(isset($_POST['user'])) {
                $dateOfBirth = new DateTime($dateOfBirth);
                $id = $userDao->register($userName, $dateOfBirth, $email, $password, 1, "", "u");
                header("Location:?action=show_clientHome");
            }
        } else {
            echo "in use";
        }
        break;
    case "show_login":
        $pageTitle='Login Page';
        $msg = filter_input(INPUT_GET, "msg", FILTER_UNSAFE_RAW);
        include "../view/login.php";
        break;
    case "do_login":
        $userDao = new UserDao("fastjobs");
        $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
       $user= $userDao->login($email,$password);
       if($user!=null){
           $_SESSION['user'] =serialize($user);
           header("Location:?action=show_clientHome");
       }
       else {
           header("Location:?action=show_login&msg=sorry credentials do not match ");
       }
        break;
    case "show_clientHome":
        $pageTitle='Home Page';
        include "../view/clientHome.php";
        break;
    case "send_Message":
        $user=unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $message = filter_input(INPUT_POST, "message", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $insertState=$messageDao->insertMessage($inboxId,$user->getId(),$message,1 );
        if($insertState>0){
            $msg=$messageDao->getMessageById($insertState);
            $ibpDao= new InboxParticipantsDao("fastjobs");
            $ibpDao->updateUnseenMessages($user->getId(),$inboxId,1);
            //update the users lastsent
            $ibpDao->updateLastSent($inboxId,$msg->getTimeSent());
            echo "worked";
        }
        break;
    case "show_conversations":
        $pageTitle='Conversations';
        $user=unserialize($_SESSION['user']);
        include "../view/conversations.php";
        break;

    case "get_Messages":
        $user=unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $messages=$messageDao->getMessages($inboxId);
        $jsonMessages="";
        $length=count($messages);
        $msgs = [];
        for($i=0; $i<$length; $i++){
         $msg = [];
            $msg[0]=$messages[$i]->getMessageId();
            $msg[1]=$messages[$i]->getInboxId();
            $msg[2]=$messages[$i]->getSenderId();
            $msg[3]=$messages[$i]->getMessage();
            $msg[4]=$messages[$i]->getMessageType();
            $msg[5]=date_format($messages[$i]->getTimeSent(),"Y-m-d H:i:s");
            $date=date_format($messages[$i]->getTimeSent(),"Y-m-d");
            if(date("Y-m-d")==$date){
                $msg[5]="Today";
            }
            $msg[6]=$messages[$i]->isDeletedState();
            array_push($msgs, $msg);
        }
        $_SESSION['lastSeen'] =$messages[0]->getTimeSent();
        $messages=json_encode($msgs);
        echo $messages;
        break;
    case "get_ibps":
        $user=unserialize($_SESSION['user']);
        $userDao = new UserDao("fastjobs");
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $inboxParticipants=$ibpDao->getInboxParticipants($user->getId());
        $length=count($inboxParticipants);
        $ibps = [];
        for($i=0; $i<$length; $i++){
            $ibp = [];
            $ibp[0]=$inboxParticipants[$i]->getUserId();
            $ibp[1]=$inboxParticipants[$i]->getInboxId();
            $ibp[2]=$inboxParticipants[$i]->isDeletedState();
            $ibp[3]=$inboxParticipants[$i]->getUnSeenMessages();
            $ibp[4]=$inboxParticipants[$i]->isOpen();
            $ibp[5]= $userDao->getUserById($ibp[0])->getName();

            array_push($ibps, $ibp);
        }
        $allIbps=json_encode($ibps);
        echo $allIbps;
        break;
}