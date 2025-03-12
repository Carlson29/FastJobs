<?php

use Daos\InboxDao;
use Daos\InboxParticipantsDao;
use Daos\MessageDao;

session_start();
//use UserDao;
//require '..\Daos\Dao.php';
//require '..\business\User.php';
require '..\Daos\UserDao.php';
require '..\Daos\MessageDao.php';
require '..\Daos\InboxParticipantsDao.php';
require '..\Daos\InboxDao.php';
require '..\business\Miscellaneous.php';

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
                // echo "helloo" . $id;
            } else if (isset($_POST['user'])) {
                $dateOfBirth = new DateTime($dateOfBirth);
                $id = $userDao->register($userName, $dateOfBirth, $email, $password, 1, "", "u");
                header("Location:?action=show_clientHome");
            }
        } else {
            echo "in use";
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
            header("Location:?action=show_clientHome");
        } else {
            header("Location:?action=show_login&msg=sorry credentials do not match ");
        }
        break;
    case "show_clientHome":
        $pageTitle = 'Home Page';
        include "../view/clientHome.php";
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
        $m = new Miscellaneous();
        //chnage file name
        $target_file = basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        $date = new DateTime();
        $date = $date->format('Y-m-d H-i-s') . "." . $imageFileType;
        /*if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }*/

        // if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir .$date)) {
        if ($m->uploadFile($target_dir, $_FILES, $date)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            $messageDao = new MessageDao("fastjobs");
            $insertState = $messageDao->insertMessage($inboxId, $user->getId(), $date, 2);
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
        $user = unserialize($_SESSION['user']);
        include "../view/conversations.php";
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
                array_push($ibps, $ibp);
            }
        }
        $allIbps = json_encode($ibps);
        echo $allIbps;
        break;
    case "get_New_Messages":
        $lastSent = unserialize($_SESSION['lastSeenMessage']);
        $inboxId = filter_input(INPUT_POST, "inboxId", FILTER_UNSAFE_RAW);
        $messageDao = new MessageDao("fastjobs");
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
    case "close_Previous_Ibp":
        $user = unserialize($_SESSION['user']);
        $prevId = unserialize($_SESSION['previousInbox']);
        $ibpDao = new InboxParticipantsDao("fastjobs");
        $ibpDao->updateIsOpen($user->getId(), $prevId, false);
        break;
    case "get_Workers_By_Location":
        $userDao = new UserDao("fastjobs");
        $mySelf = unserialize($_SESSION['user']);
        $mySelf = $userDao->getUserById($mySelf->getId());
        $myLong = (float)$mySelf->getLongitude();
        $myLat = (float)$mySelf->getLatitude();
        $lat1 = deg2rad($myLat);
        $lon1 = deg2rad($myLong);
        $earth_radius = 6371.0;
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
                $lat = $users[$i]->getLongitude();
                $long = $users[$i]->getLatitude();

                // Convert degrees to radians
                $lat2 = deg2rad($lat);
                $lon2 = deg2rad($long);

                // Differences in coordinates
                $dlat = $lat2 - $lat1;
                $dlon = $lon2 - $lon1;
// Haversine formula
                $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $distance = $earth_radius * $c;

                if ($distance < 30) {
                    $users[$i]->setDistance($distance);
                    array_push($closeUsers, $users[$i]);
                    $tracker++;
                }

            }
            $count = $count - $tracker;
            $dateJoint=$users[count($users) - 1]->getDateJoint();
        }
        $_SESSION['workerDateJoint'] = serialize($users[count($users) - 1]->getDateJoint());
        $allUsers = [];
        foreach ($closeUsers as $u) {
            $user = [];
            $user[0] = $u->getId();
            $user[1] = $u->getName();
            $user[2] = $u->getProfilePic();
            $user[3] = $u->getDistance();
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
            $dateJoint=$users[count($users) - 1]->getDateJoint();
        }
        $_SESSION['workerDateJoint'] = serialize($users[count($users) - 1]->getDateJoint());
        $allUsers = [];
        foreach ($closeUsers as $u) {
            $user = [];
            $user[0] = $u->getId();
            $user[1] = $u->getName();
            $user[2] = $u->getProfilePic();
            $user[3] = $u->getDistance();
            array_push($allUsers, $user);
        }
        $allUsers = json_encode($allUsers);
        echo $allUsers;
        break;

}