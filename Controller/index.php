<?php

use Daos\InboxDao;
use Daos\InboxParticipantsDao;
use Daos\MediaDao;
use Daos\MessageDao;
use Daos\PostDao;
use Daos\UserDao;
use business\Miscellaneous;
use Daos\Dao;
use business\User;

session_start();

//use DateTime;

//use UserDao;
//require '..\Daos\Dao.php';
//require '..\business\User.php';
require '..\Daos\Dao.php';
require '..\Daos\UserDao.php';
require '..\Daos\MessageDao.php';
require '..\Daos\InboxParticipantsDao.php';
require '..\Daos\InboxDao.php';
require '..\business\Miscellaneous.php';
require '..\Daos\PostDao.php';
require '..\Daos\MediaDao.php';
//require_once '..\business\User.php';
//require '..\business\User.php';

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
        $pageTitle = 'SignUp Page';
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
                header("Location:?action=show_login&msg=Registered");
                // echo "helloo" . $id;
            } else if (isset($_POST['user'])) {
                $dateOfBirth = new DateTime($dateOfBirth);
                $id = $userDao->register($userName, $dateOfBirth, $email, $password, 1, "", "u");
                header("Location:?action=show_login&msg=Registered");
            }
        } else {
            header("Location:?action=show_login&msg=Email in use");
        }
        break;
    case "show_login":
        $pageTitle = 'Login Page';
        $msg = filter_input(INPUT_GET, "msg", FILTER_UNSAFE_RAW);
        include "../view/login.php";
        break;
    case "do_login":
        $userDao = new UserDao("fastjobs");
        $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
        $user = $userDao->login($email, $password);
        if ($user != null) {
            $_SESSION['user'] = serialize($user);
            if ($user->getUserType() == 1) {
                header("Location:?action=show_clientHome");
            } else if ($user->getUserType() == 2) {
                header("Location:?action=show_workerHome");
            }
        } else {
            header("Location:?action=show_login&msg=sorry credentials do not match ");
        }
        break;
    case "show_clientHome":
        $pageTitle = 'Home Page';
        $user = unserialize($_SESSION['user']);
        if (isset($_SESSION['previousInbox'])) {
            $ibpDao= new InboxParticipantsDao("fastjobs");
            $prevId = unserialize($_SESSION['previousInbox']);
                $ibpDao->updateIsOpen($user->getId(), $prevId, false);
        }
        include "../view/clientHome.php";
        break;
    case "show_workerHome":
        $pageTitle = 'Home Page';
        $user = unserialize($_SESSION['user']);
        include "../view/workerHome.php";
        break;
    case "send_Message":
        $user = unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $message = filter_input(INPUT_POST, "message", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $insertState = $messageDao->insertMessage($inboxId, $user->getId(), $message, 1);
        if ($insertState > 0) {
            $msg = $messageDao->getMessageById($insertState);
            $ibpDao = new InboxParticipantsDao("fastjobs");
            $ibpDao->updateUnseenMessages($user->getId(), $inboxId, 1);
            //update the users lastsent
            $ibpDao->updateLastSent($inboxId, $msg->getTimeSent());
            //echo $state;
        }
        break;
    case "send_File":
        $user = unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $target_dir = "../messageImages/";
        $messageType=-1;
        $m = new Miscellaneous();
        //chnage file name
        $target_file = basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        $date = new DateTime();
        $date = $date->format('Y-m-d H-i-s') . '_' . uniqid() . "." . $imageFileType;
        /*if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }*/

        // if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir .$date)) {
    if($m->checkFileType($date)=="video"){
        $target_dir = "../messageVideos/";
        $messageType=3;
    }
    else if ($m->checkFileType($date)=="image"){
        $target_dir = "../messageImages/";
        $messageType=2;
    }
        if ($m->uploadFile2($target_dir, $_FILES["file"]["tmp_name"], $date)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            $messageDao = new MessageDao("fastjobs");
            $insertState = $messageDao->insertMessage($inboxId, $user->getId(), $date, $messageType);
            if ($insertState > 0) {
                $msg = $messageDao->getMessageById($insertState);
                $ibpDao = new InboxParticipantsDao("fastjobs");
                $ibpDao->updateUnseenMessages($user->getId(), $inboxId, 1);
                //update the users lastsent
                $ibpDao->updateLastSent($inboxId, $msg->getTimeSent());
                //echo $state;
            }

            header('Content-Type: text/plain');
            echo "Your response message here";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        break;
    case "send_First_Message":
        $user = unserialize($_SESSION['user']);
        $otherUserId = filter_input(INPUT_POST, "userId", FILTER_UNSAFE_RAW);
        $message = filter_input(INPUT_POST, "message", FILTER_UNSAFE_RAW);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $messageDao = new MessageDao("fastjobs");
        $myIbps = $ibpDao->getInboxParticipants($user->getId());
        $otherUserIbps = $ibpDao->getInboxParticipants($otherUserId);
        $id = 0;
        for ($i = 0; $i < count($myIbps); $i++) {
            for ($k = 0; $k < count($otherUserIbps); $k++) {
                if ($myIbps[$i]->getInboxId() == $otherUserIbps[$k]->getInboxId()) {
                    $id = $myIbps[$i]->getInboxId();
                    break;
                }
            }
            if ($id > 0) {
                break;
            }
        }
        if ($id == 0) {
            $inboxDao = new InboxDao("fastjobs");
            $id = $inboxDao->createInbox(1, -1, "");
        }
        if ($id > 0) {
            $ibpDao->insertInboxParticipants($user->getId(), $id, false, 0, true);
            $ibpDao->insertInboxParticipants($otherUserId, $id, false, 0, false);
            $insertState = $messageDao->insertMessage($id, $user->getId(), $message, 1);
            if ($insertState > 0) {
                $msg = $messageDao->getMessageById($insertState);
                $ibpDao->updateUnseenMessages($user->getId(), $id, 1);
                //update the users lastsent
                $ibpDao->updateLastSent($id, $msg->getTimeSent());
                //echo "worked";
            }
        }
        echo $id;
        break;
    case "get_inboxId":
        $user = unserialize($_SESSION['user']);
        $otherUserId = filter_input(INPUT_POST, "userId", FILTER_UNSAFE_RAW);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $myIbps = $ibpDao->getInboxParticipants($user->getId());
        $otherUserIbps = $ibpDao->getInboxParticipants($otherUserId);
        $id = 0;
        for ($i = 0; $i < count($myIbps); $i++) {
            for ($k = 0; $k < count($otherUserIbps); $k++) {
                if ($myIbps[$i]->getInboxId() == $otherUserIbps[$k]->getInboxId()) {
                    $id = $myIbps[$i]->getInboxId();
                    break;
                }
            }
            if ($id > 0) {
                break;
            }
        }
        echo $id;
        break;
    case "show_conversations":
        $pageTitle = 'Conversations';
        $otherUserId = filter_input(INPUT_GET, "otherUserId", FILTER_UNSAFE_RAW);
        if ($otherUserId == null || $otherUserId == "") {
            $otherUserId = 0;
        }
        $user = unserialize($_SESSION['user']);
        include "../view/conversations.php";
        break;

    case "close_Previous_Ibp":
        $user = unserialize($_SESSION['user']);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        if (isset($_SESSION['previousInbox'])) {
            $prevId = unserialize($_SESSION['previousInbox']);
                $ibpDao->updateIsOpen($user->getId(), $prevId, false);
        }
        break;

    case "get_Messages":
        $user = unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $messages = $messageDao->getMessages($inboxId);
        if (isset($_SESSION['previousInbox'])) {
            $prevId = unserialize($_SESSION['previousInbox']);
            if ($prevId != $inboxId) {
                $ibpDao->updateIsOpen($user->getId(), $prevId, false);
            }
        }
        $_SESSION['previousInbox'] = serialize($inboxId);
        $ibpDao->updateIsOpen($user->getId(), $inboxId, true);
        $ibpDao->updateUnseenMessages($user->getId(), $inboxId, 0);
        $jsonMessages = "";
        $length = count($messages);
        $msgs = [];
        for ($i = 0; $i < $length; $i++) {
            $msg = [];
            $msg[0] = $messages[$i]->getMessageId();
            $msg[1] = $messages[$i]->getInboxId();
            $msg[2] = $messages[$i]->getSenderId();
            $msg[3] = $messages[$i]->getMessage();
            $msg[4] = $messages[$i]->getMessageType();
            $msg[5] = date_format($messages[$i]->getTimeSent(), "Y-m-d H:i:s");
            $date = date_format($messages[$i]->getTimeSent(), "Y-m-d");
            if (date("Y-m-d") == $date) {
                $msg[5] = "Today";
            }
            $msg[6] = $messages[$i]->isDeletedState();
            array_push($msgs, $msg);
        }
        if ($length > 0) {
            $_SESSION['lastSeenMessage'] = serialize($messages[0]->getTimeSent());
            $_SESSION['firstSeenMessage'] = serialize($messages[$length - 1]->getTimeSent());
        }
        $messages = json_encode($msgs);
        echo $messages;
        break;
    case "get_ibps":
        $user = unserialize($_SESSION['user']);
        $userDao = new UserDao("fastjobs");
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $inboxDao = new InboxDao("fastjobs");
        $messageDao = new MessageDao("fastjobs");
        $inboxParticipants = $ibpDao->getInboxParticipants($user->getId());
        $length = count($inboxParticipants);
        $ibps = [];
        for ($i = 0; $i < $length; $i++) {
            $ibp = [];
            $inbox = $inboxDao->getInbox($inboxParticipants[$i]->getInboxId());
            if ($inbox->getInboxType() == 1) {
                $otherIbp = $ibpDao->getOtherIbp($inboxParticipants[$i]->getInboxId(), $user->getId());
                $otherUser = $userDao->getUserById($otherIbp->getUserId());
                $lastMessage = $messageDao->getLastMessage($inboxParticipants[$i]->getInboxId());
                //here..........
                $ibp[0] = $inboxParticipants[$i]->getInboxId();
                $ibp[1] = date_format($inboxParticipants[$i]->getLastSent(), "Y-m-d H:i:s");;
                $ibp[2] = $inboxParticipants[$i]->getUnSeenMessages();
                $ibp[3] = $lastMessage->getMessage();
                $ibp[4] = $otherUser->getName();
                $ibp[5] = $otherUser->getProfilePic();
                $ibp[6] = $otherIbp->getUserId();
                array_push($ibps, $ibp);
            }
        }
        $allIbps = json_encode($ibps);
        echo $allIbps;
        break;
    case "get_New_Messages":
        $user = unserialize($_SESSION['user']);
        $lastSent = unserialize($_SESSION['lastSeenMessage']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $ibpDao->updateIsOpen($user->getId(), $inboxId, true);
        $messages = $messageDao->getNewMessages($inboxId, $lastSent);
        $jsonMessages = "";
        $length = count($messages);
        $msgs = [];
        for ($i = 0; $i < $length; $i++) {
            $msg = [];
            $msg[0] = $messages[$i]->getMessageId();
            $msg[1] = $messages[$i]->getInboxId();
            $msg[2] = $messages[$i]->getSenderId();
            $msg[3] = $messages[$i]->getMessage();
            $msg[4] = $messages[$i]->getMessageType();
            $msg[5] = date_format($messages[$i]->getTimeSent(), "Y-m-d H:i:s");
            $date = date_format($messages[$i]->getTimeSent(), "Y-m-d");
            if (date("Y-m-d") == $date) {
                $msg[5] = "Today";
            }
            $msg[6] = $messages[$i]->isDeletedState();
            array_push($msgs, $msg);
        }
        if ($length > 0) {
            $_SESSION['lastSeenMessage'] = serialize($messages[0]->getTimeSent());
        }
        $messages = json_encode($msgs);
        echo $messages;
        break;
    case "get_Previous_Messages":
        $firstSeen = unserialize($_SESSION['firstSeenMessage']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
        $messages = $messageDao->getPreviousMessages($inboxId, $firstSeen);
        $length = count($messages);
        $msgs = [];
        for ($i = 0; $i < $length; $i++) {
            $msg = [];
            $msg[0] = $messages[$i]->getMessageId();
            $msg[1] = $messages[$i]->getInboxId();
            $msg[2] = $messages[$i]->getSenderId();
            $msg[3] = $messages[$i]->getMessage();
            $msg[4] = $messages[$i]->getMessageType();
            $msg[5] = date_format($messages[$i]->getTimeSent(), "Y-m-d H:i:s");
            $date = date_format($messages[$i]->getTimeSent(), "Y-m-d");
            if (date("Y-m-d") == $date) {
                $msg[5] = "Today";
            }
            $msg[6] = $messages[$i]->isDeletedState();
            array_push($msgs, $msg);
        }
        if ($length > 0) {
            $_SESSION['firstSeenMessage'] = serialize($messages[$length - 1]->getTimeSent());
        }
        $messages = json_encode($msgs);
        echo $messages;
        break;
    case "getMessageHeader":
        $user = unserialize($_SESSION['user']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $userId = filter_input(INPUT_POST, "userId", FILTER_UNSAFE_RAW);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $userDao = new UserDao("fastjobs");
        $otherUser = new User();
        $details = [];
        if ($inboxId != 0) {
            $otherIbp = $ibpDao->getOtherIbp($inboxId, $user->getId());
            $otherUser = $userDao->getUserById($otherIbp->getUserId());
        }
        if ($userId != 0) {
            $otherUser = $userDao->getUserById($userId);
        }
        $details[0] = $otherUser->getName();
        $details[1] = $otherUser->getProfilePic() . "";
        $details[2] = "online";
        $details = json_encode($details);
        echo $details;
        break;
   /* case "close_Previous_Ibp":
        $user = unserialize($_SESSION['user']);
        $prevId = unserialize($_SESSION['previousInbox']);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $ibpDao->updateIsOpen($user->getId(), $prevId, false);
        break;*/
    case "store_Location":
        $user = unserialize($_SESSION['user']);
        $latitude = filter_input(INPUT_POST, "latitude", FILTER_UNSAFE_RAW);
        $longitude = filter_input(INPUT_POST, "longitude", FILTER_UNSAFE_RAW);
        $userDao = new userDao("fastjobs");
        $userDao->updateLocation($longitude, $latitude, $user->getId());

        break;
    case "get_Workers_By_Location":
        $_SESSION['workerDateJoint2'] = serialize(null);
        $userDao = new UserDao("fastjobs");
        $m = new Miscellaneous();
        $mySelf = unserialize($_SESSION['user']);
        $mySelf = $userDao->getUserById($mySelf->getId());
        $lon1 = (float)$mySelf->getLongitude();
        $lat1 = (float)$mySelf->getLatitude();
        $dateJoint = "";
        $count = 20;
        $firstLoop = "";
        if (isset($_SESSION['workerDateJoint']) && unserialize($_SESSION['workerDateJoint']) != null) {
            $dateJoint = unserialize($_SESSION['workerDateJoint']);
            $firstLoop = false;

        } else {
            $firstUser = $userDao->getFirstUser();
            $dateJoint = $firstUser->getDateJoint();
            $firstLoop = true;
            //$users = $userDao->getUsers($dateJoint, $count);
        }
        $num = $count;
        //$destination = new Destination();
        $closeUsers = [];
        //track the number that was added through out the while loop
        $tracker = 0;
        $users = [];
        $lat2 = "";
        $lon2 = "";
        //$up=[];
        while ($tracker < $num) {
            //get users
            $users = $userDao->getUsers($dateJoint, $count, $firstLoop, $mySelf->getId());
            $firstLoop = false;
            if (count($users) == 0 || $users == null) {
                break;
            }
            //keep track if a user was added
            $add = false;
            //track the number that was added during a particular loop
            $added = 0;
            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]->getLongitude() != null && $users[$i]->getLatitude() != null) {
                    // $destination = new Destination();
                    $lon2 = (float)$users[$i]->getLongitude();
                    $lat2 = (float)$users[$i]->getLatitude();
                    $destination = $m->googleGetDistance($lon1, $lat1, $lon2, $lat2);
                    if ($destination != null && $m->verifyDistance(30, $destination->getDistance())) {
                        $users[$i]->setDestination($destination);
                        array_push($closeUsers, $users[$i]);
                        $tracker++;
                        $added++;
                        $add = true;
                    } else {
                        array_push($closeUsers, $users[$i]);
                        $tracker++;
                        $added++;
                        $add = true;
                    }
                } //add those who don't have their location registered
                else {
                    array_push($closeUsers, $users[$i]);
                    $tracker++;
                    $added++;
                    $add = true;
                }
            }
            if ($add == true) {
                $count = $count - $added;

            }
            $dateJoint = $users[count($users) - 1]->getDateJoint();
            $_SESSION['workerDateJoint'] = serialize($users[count($users) - 1]->getDateJoint());
        }

        $allUsers = [];
        for ($i = 0; $i < count($closeUsers); $i++) {
            $user = [];
            $user[0] = $closeUsers[$i]->getId();
            $user[1] = $closeUsers[$i]->getName();
            $user[2] = $closeUsers[$i]->getProfilePic();
            if ($closeUsers[$i]->getDestination() == null) {
                $user[3] = " ";
            } else {
                $user[3] = $closeUsers[$i]->getDestination()->getDistance() . "";
            }
            array_push($allUsers, $user);
        }
        $allUsers = json_encode($allUsers);
        echo $allUsers;
        //echo $lon1 ." ++ ". $lat1 ;
        break;
    case "get_Workers_By_Category":
        $user = unserialize($_SESSION['user']);
        $_SESSION['workerDateJoint'] = serialize(null);
        $catId = filter_input(INPUT_POST, "categoryId", FILTER_UNSAFE_RAW);
        $userDao = new UserDao("fastjobs");
        $m = new Miscellaneous();
        $mySelf = unserialize($_SESSION['user']);
        $mySelf = $userDao->getUserById($mySelf->getId());
        $lon1 = (float)$mySelf->getLongitude();
        $lat1 = (float)$mySelf->getLatitude();
        $dateJoint = "";
        $count = 20;
        $firstLoop = "";
        if (isset($_SESSION['workerDateJoint2']) && unserialize($_SESSION['workerDateJoint2']) != null) {
            $dateJoint = unserialize($_SESSION['workerDateJoint2']);
            $firstLoop = false;
        } else {
            $firstUser = $userDao->getFirstUser();
            $dateJoint = $firstUser->getDateJoint();
            $firstLoop = true;
            //$users = $userDao->getUsers($dateJoint, $count);
        }
        $num = $count;
        $distance = -1;
        $closeUsers = [];
        //track the number that was added through out the while loop
        $tracker = 0;
        $users = [];
        $lat2 = "";
        $lon2 = "";
        //$up=[];
        while ($tracker < $num) {
            //get users
            $users = $userDao->getUsersByCategory($dateJoint, $count, $firstLoop, $mySelf->getId(), $catId);
            $firstLoop = false;
            if (count($users) == 0 || $users == null) {
                break;
            }
            //keep track if a user was added
            $add = false;
            //track the number that was added during a particular loop
            $added = 0;
            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]->getLongitude() != null && $users[$i]->getLatitude() != null) {
                    $lon2 = (float)$users[$i]->getLongitude();
                    $lat2 = (float)$users[$i]->getLatitude();
                    $destination = $m->googleGetDistance($lon1, $lat2, $lon2, $lat2);
                    if ($destination != null && $m->verifyDistance(30, $destination->getDistance())) {
                        $users[$i]->setDestination($destination);
                        array_push($closeUsers, $users[$i]);
                        $tracker++;
                        $added++;
                        $add = true;
                    }

                } //add those who don't have their location registered
                else {
                    array_push($closeUsers, $users[$i]);
                    $tracker++;
                    $added++;
                    $add = true;
                }
            }
            if ($add == true) {
                $count = $count - $added;

            }
            $dateJoint = $users[count($users) - 1]->getDateJoint();
            $_SESSION['workerDateJoint2'] = serialize($users[count($users) - 1]->getDateJoint());
        }

        $allUsers = [];
        for ($i = 0; $i < count($closeUsers); $i++) {
            $user = [];
            $user[0] = $closeUsers[$i]->getId();
            $user[1] = $closeUsers[$i]->getName();
            $user[2] = $closeUsers[$i]->getProfilePic();
            if ($closeUsers[$i]->getDestination() == null) {
                $user[3] = " ";
            } else {
                $user[3] = $closeUsers[$i]->getDestination()->getDistance() . "";
            }
            array_push($allUsers, $user);
        }
        $allUsers = json_encode($allUsers);
        echo $allUsers;
        break;
    case "get_Workers":
        $userDao = new UserDao("fastjobs");

        $dateJoint = "";
        $count = 20;
        if (isset($_SESSION['workerDateJoint'])) {
            if (unserialize($_SESSION['workerDateJoint']) != null) {
                $dateJoint = unserialize($_SESSION['workerDateJoint']);
            }
        } else {
            $firstUser = $userDao->getFirstUser();
            $dateJoint = $firstUser->getDateJoint();
            //$users = $userDao->getUsers($dateJoint, $count);
        }
        $num = $count;
        $distance = 0;
        $closeUsers = [];
        $tracker = 0;
        while ($tracker < $num) {
            $users = $userDao->getUsers($dateJoint, $count);
            if ($users == null) {
                break;
            }
            //$tracker=0;
            for ($i = 0; $i < count($users); $i++) {
                array_push($closeUsers, $users[$i]);
                $tracker++;


            }
            $count = $count - $tracker;
            $dateJoint = $users[count($users) - 1]->getDateJoint();
        }
        $_SESSION['workerDateJoint'] = serialize($users[count($users) - 1]->getDateJoint());
        $allUsers = [];
        foreach ($closeUsers as $u) {
            $user = [];
            $user[0] = $u->getId();
            $user[1] = $u->getName();
            $user[2] = $u->getProfilePic() . "";
            $user[3] = $u->getDistance();
            array_push($allUsers, $user);
        }
        $allUsers = json_encode($allUsers);
        echo $allUsers;
        break;
    case "search_Cat_Worker":
        $search = filter_input(INPUT_POST, "searchInput", FILTER_UNSAFE_RAW);
        $userDao = new UserDao("fastjobs");
        $categories = $userDao->searchWorkers($search);
        $allCategories = [];
        foreach ($categories as $category) {
            $cat = [];
            if ($category[2] == "u") {
                $user = $userDao->getUserById($category[0]);
                $cat[0] = $user->getId();
                $cat[1] = $user->getName();
                $cat[2] = $category[2];
                $cat[3] = $user->getProfilePic() . "";
            } else if ($category[2] == "c") {
                $cat[0] = $category[0];
                $cat[1] = $category[1];
                $cat[2] = $category[2];
                $cat[3] = "";
            }
            array_push($allCategories, $cat);
        }

        $allCat = json_encode($allCategories);
        echo $allCat;
        break;
    case "show_Profile":
        $userDao = new UserDao("fastjobs");
        $mySelf = unserialize($_SESSION['user']);
        $mySelf = $userDao->getUserById($mySelf->getId());
        $user = $mySelf;
        include "../View/profile.php";
        break;
    case "show_User_Profile":
        $user = unserialize($_SESSION['user']);
        $userId = filter_input(INPUT_GET, "id", FILTER_UNSAFE_RAW);
        $userDao = new UserDao("fastjobs");
        $mySelf = $userDao->getUserById($userId);
        include "../View/profile.php";
        break;
    case "clear_DateTime":
        $_SESSION['workerDateJoint'] = serialize(null);
        $_SESSION['workerDateJoint2'] = serialize(null);
        break;
    case "logout":
        $user = unserialize($_SESSION['user']);
        $userDao = new UserDao("fastjobs");
        $userDao->updateLogOutTime($user->getId());

        session_destroy();
        header("Location: ?action=show_login");
        break;
    case "get_Worker_Pictures":
        //$files = glob('path/to/your/folder/*.*'); // You can change the pattern
        //$files = glob('../tradesPeoplePictures/*.png');
        $folder = "../tradesPeoplePictures/";
        $files = array_diff(scandir($folder), array('.', '..'));
        $allFiles = [];
        $i = 0;
        foreach ($files as $file) {
            if (is_file($folder . DIRECTORY_SEPARATOR . $file)) {
                $allFiles[$i] = $file;
                $i++;
            }
        }
        $allFiles = json_encode($allFiles);
        echo $allFiles;
        break;
    case "show_feed":
        $user = unserialize($_SESSION['user']);
        include "../View/jobsFeed.php";
        break;
    case "upload_feed":
        $user = unserialize($_SESSION['user']);
        $about = filter_input(INPUT_POST, "aboutFeed", FILTER_UNSAFE_RAW);
        $target_dir = "../feedMedia/";
        $m = new Miscellaneous();
        $postDao = new PostDao("fastjobs");
        $mediaDao = new MediaDao("fastjobs");
        $files = [];
        $response = [];
        $success = false;
        //check if files are available
        if (!empty($_FILES['files'])) {
            // $target_file= basename($_FILES["files"]["name"]);
            for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                if ($_FILES['files']['error'][$i] == UPLOAD_ERR_OK) {
                    //get the extension
                    $imageFileType = strtolower(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));
                    $date = new DateTime();
                    //give file a new name
                    $date = $date->format('Y-m-d H-i-s') . '_' . uniqid() . "." . $imageFileType;
                    //upload to directory
                    if ($m->uploadFile2($target_dir, $_FILES['files']['tmp_name'][$i], $date)) {
                        $files[$i] = $date;
                        $success = true;
                    } else {
                        $success = false;

                    }
                }
                if (!$success) {
                    break;
                }

            }
        }
        if ($success) {
            $postId = $postDao->createPost($user->getId(), $user->getUserType(), $about);
            if ($postId > 0) {
                foreach ($files as $file) {
                    $type = -1;
                    if ($m->checkFileType($file) == 'image') {
                        $type = 1;
                    } else if ($m->checkFileType($file) == 'video') {
                        $type = 2;
                    }
                    $mediaDao->createMedia($postId, $file, $type);
                }
                $response = [
                    'success' => true,
                    'message' => "files uploaded successfully.",
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => "upload failed.",
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => "upload failed.",
            ];
        }
// Return JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    case "get_Feed":
        $user = unserialize($_SESSION['user']);
        $postDao = new PostDao("fastjobs");
        $mediaDao = new MediaDao("fastjobs");
        $userDao = new UserDao("fastjobs");
        $m = new Miscellaneous();
        $lon1 = (float)$user->getLongitude();
        $lat1 = (float)$user->getLatitude();
        $max = 10;
        $numSelected = 0;
        $numLeft = 10;
        $loopCounter = 0;
        $filteredPosts = [];
        // $minDate=$user->getLastLogOut();
        //get dateTime 2 days ago
        $minDate = new DateTime(Date('Y-m-d H:i:s', strtotime('-2 days')));
        //$minDate = new DateTime("2025/07/20");
        //check for maxFeedTime
        if (isset($_SESSION['maxFeedTime']) && unserialize($_SESSION['maxFeedTime']) != null) {
            $minDate = unserialize($_SESSION['maxFeedTime']);
        }

        //while number selected is less than max
        while ($numSelected < $max) {
            $firstLoop = false;
            $posts=[];
            //check if it's the first time the user is trying to access the feed page
            if ($loopCounter == 0) {
                $firstLoop = true;
                $loopCounter++;
            }
            //check if it's not the first time the user is trying to access the feed page
            if (isset($_SESSION['maxFeedTime']) && unserialize($_SESSION['maxFeedTime']) != null) {
                $firstLoop = false;
            }
            if($firstLoop==true) {
                //get post
                $posts = $postDao->getPost($minDate, $numLeft, $firstLoop);
            }
            else if($firstLoop==false) {
                //get older post
               $posts = $postDao->getOlderPost($minDate, $numLeft);
            }
            //if no recent post is available stop loop
            if (count($posts) == 0) {
                break;
            }
            $added = false;
            //loop through post
            foreach ($posts as $post) {
                $tempUser = $userDao->getUserById($post->getUserId());
                $lon2 = (float)$tempUser->getLongitude();
                $lat2 = (float)$tempUser->getLatitude();
                $destination = $m->googleGetDistance($lon1, $lat1, $lon2, $lat2);
                //verify both users are in close proximity
                if ($m->verifyDistance(1000, $destination->getDistance())) {
                    $filteredPosts[$numSelected] = $post;
                    //track number of users
                    $numSelected++;
                    $added = true;
                }
            }
            //if a close user was found, subtract from max to get number left
            if ($added) {
                $numLeft = $max - $numSelected;
            }
            if(count($posts)>0) {
                //set minDate to last date in array
                $minDate = $posts[count($posts) - 1]->getDateTime();
            }
        }
        //if filtered post array is not empty,
        if (count($filteredPosts) > 0) {
            $_SESSION['maxFeedTime'] = serialize($minDate);
        }
        $allMedia = [];
        //loop through filtered post
        for ($i = 0; $i < count($filteredPosts); $i++) {
            //get all media related to the post
            $singleFeed = $mediaDao->getMedia($filteredPosts[$i]->getPostId());
            $u = $userDao->getUserById($filteredPosts[$i]->getUserId());
            $feed = [];
            $feed[0] = $u->getName();
            $userMedia = [];
            for ($j = 0; $j < count($singleFeed); $j++) {
                $singleMedia = [];
                $singleMedia[0] = $singleFeed[$j]->getMedia();
                $singleMedia[1] = $singleFeed[$j]->getType();
                $userMedia[$j] = $singleMedia;
            }
            $feed[1] = $userMedia;
            $feed[2] = $u->getProfilePic()."";
            $feed[3] = $filteredPosts[$i]->getDateTime()->format('Y-m-d H:i:s');
            $feed[4] = $filteredPosts[$i]->getType();
            $feed[5] = $filteredPosts[$i]->getAbout();
                //$feed[2]=$$filteredPosts[$i]->getPostId();
            array_push($allMedia, $feed);
        }
        echo json_encode($allMedia);
        break;
    case 'reload_feed':
        $_SESSION['maxFeedTime'] = serialize(null);
        break;
}