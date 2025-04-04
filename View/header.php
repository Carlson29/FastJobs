<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <style>
        :root {
            --base-width: 200px;
            --base-height: 100px;
        }

        #header {
            height: 50px;
            /*#3b3c36*/
            background-color: #4C676B;
            width: 100%;
            overflow: hidden;
        }

        #foot {
            height: 50px;
            background-color: #4C676B;
            position: fixed;
            bottom: 0;
            color: #3b3c36;
            width: 100%;
        }

        #signUpDiv {
            text-align: center;
            overflow: hidden;
        }

        @media (min-width: 320px) and (max-width: 1024px) {
            #signUpForm {
                padding-top: 1%;
                height: 90%;
                margin-top: 10%;
                margin-left: 2%;
                margin-right: 2%;
                border: 3px transparent;
                background-color: whitesmoke;
                border-radius: 15px;
            }

            #loginForm{
                padding-top: 1%;
                height: 90%;
                margin-top: 30.5%;
                margin-left: 2%;
                margin-right: 2%;
                border: 3px transparent;
                background-color: whitesmoke;
                border-radius: 15px;
            }

            #validateButton {
                margin-top: 3%;
                margin-bottom: 45%;
                /* border-radius: 15px;
                 background-color: #6A6A6A;*/
            }
            #loginValidateButton{
                margin-top: 1%;
                margin-bottom: 70%;
            }
        }

        @media (min-width: 1025px) {
            #signUpForm {
                padding-top: 1%;
                height: 90%;
                margin-top: 10%;
                margin-left: 30%;
                margin-right: 30%;
                border: 3px transparent;
                background-color: whitesmoke;
                border-radius: 15px;
            }

            #loginForm{
                padding-top: 1%;
                height: 90%;
                margin-top: 15%;
                margin-left: 30%;
                margin-right: 30%;
                border: 3px transparent;
                background-color: whitesmoke;
                border-radius: 15px;
            }

            #validateButton {
                margin-top: 1%;
                margin-bottom: 25%;
                /*border-radius: 15px;
                background-color: #6A6A6A;*/
            }
            #loginValidateButton{
                margin-top: 1%;
                margin-bottom: 33%;
            }
        }

        #errorMessage {
            color: red;
        }

        button {
            border-radius: 40px;
            background-color: #6A6A6A;
        }

        #loginPage,
        #signUpPage {
            background-image: linear-gradient(#6A6A6A, #4C676B, #3b3c36);
            height: 100%;
            overflow: hidden;
            /*Radial Gradients ,Conic Gradients*/
        }

        #loginBody, #signUpBody {
            overflow: hidden;
        }

        input[type="text"], input[type="password"], input[type="date"], input[type="email"] {
            width: 50%;
            display: inline-block;
            border-radius: 15px;
            background-color: white;
        }

        #sideMenuButton {
            height: 40px;
            /*float: right;*/
        }

        .sidenav {
            height: 100%;
            width: 4vw;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            /*  padding-top: 5vh;
              margin-left: 97vw;*/
        }

        .sidenav a {
            /*padding: 8px 15px 8px 10px;*/
            padding: 1vw 1vw 1vw 1vw;
            text-decoration: none;
            font-size: 1.2vw;
            color: #818181;
            transition: 0.3s;
            flex-direction: column;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            /* position: absolute;
             margin-right: 16vw;
             margin-left: 0px;
             top: 2vh;*/
            font-size: 3vw;
        }


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
        global $pageTitle;
        echo $pageTitle; ?></title>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <div id="header">
        <span style="font-size:30px;cursor:pointer" id="openSideBar" onclick="openNav()"><svg
                    xmlns="http://www.w3.org/2000/svg" id="sideMenuButton" fill="currentColor"
                    class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
            </svg></span>

    </div>
    <div id="sidebar">
        <div id="mySidenav" class="sidenav">
            <a href="" class="closebtn" onclick="closeNav()">&times;</a>

            <a href="../Controller/index.php?action=show_conversations" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                    <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                </svg>
                chats </a>
            <a href="../Controller/index.php?action=show_Profile" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
                profile</a>
            <a href="../Controller/index.php?action=show_clientHome" class="button">Home</a>
        </div>


