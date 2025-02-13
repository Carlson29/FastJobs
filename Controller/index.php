<?php

session_start();
//use UserDao;
//require '..\Daos\Dao.php';
//require '..\business\User.php';
require '..\Daos\UserDao.php';

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
                //echo "hello" .$id;
            }
        } else {
            echo "in use";
        }
        break;
}