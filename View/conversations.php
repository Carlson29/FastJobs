<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <style>
        /*@media (min-width: 1025px) {*/
        body {
            overflow-y: hidden;
        }

        #conversationContents {
            display: flex;
            flex-direction: row;
        }

        #headers {
            display: flex;
            flex-direction: row;
        }

        #ibpSectionHeader {
            position: relative;
            width: 33vw;
            height: 6.5vh;
            background-color: whitesmoke;
            margin-bottom: 0.3vh;
        }

        #messageHeader {
            width: 63.5vw;
            height: 6.5vh;
            background-color: whitesmoke;
            /*margin-bottom: 0.5vh;*/
            right: 1vw;
            position: fixed;
            display: flex;
            flex-direction: row;
        }

        #messageHeaderDetails{
            display: flex;
            flex-direction: row;
        }

        #messageHeaderPicDiv{
            display: flex;
            position: relative;
            height: 6vh;
            width: 5vw;
        }

        #messageHeaderPic {
            position: relative;
            left: 15px;
            top: 0.25vh;
            height: 6vh;
            width: 4vw;
            border-radius: 2vw;
        }

        #messageHeaderName {
            position: relative;
            left: 0vw;
            bottom: 35px;
            font-size: 40px;
            text-align: center;
            width: 10vw;
            height: 6vh;
        }

        #conversationBody {
            position: fixed;
            width: 63.5vw;
            height: 83vh;
            background-color: whitesmoke;
            display: flex;
            flex-direction: column;
            right: 1vw;
            overflow-y: auto;
        }

        #myMsg {
            /*  right: 1vw;*/
            background-color: grey;
            display: inline-block;
            max-width: 55vw;
            margin-bottom: 0.3vw;
            align-self: end;
            font-size: 1.2vw;
            word-wrap: break-word;
            white-space: pre-wrap;
            border-radius: 2vw;
            padding: 1vw 1vw 1vw 1vw;
            position: relative;
            bottom: 2.2vh;
            right: 0.5vw;
            /* bottom:0.1vw ;*/
        }

        #FriendMsg {
            /* left: 1vw;*/
            background-color: grey;
            display: inline-block;
            max-width: 55vw;
            margin-bottom: 0.3vw;
            align-self: start;
            font-size: 1.2vw;
            word-wrap: break-word;
            white-space: pre-wrap;
            border-radius: 1vw;
            padding: 1vw 1vw 1vw 1vw;
            position: relative;
            left: 0.5vw;
            bottom: 2.2vh;
        }

        #sent-arrow {
            align-self: end;
        }

        #sent-arrow::after {
            content: '';
            position: relative;
            width: 0;
            height: 0;
            border-left: 1vw solid transparent;
            border-right: 1vw solid transparent;
            border-top: 1vw solid grey;
            position: absolute;
            right: 0vw;
            /* top: 0.5vh;
              left: -0.6vw;*/
        }

        #received-arrow {
            align-self: start;

        }

        #sent-msg {
            align-self: end;
        }

        #received-msg {
            align-self: start;
        }

        #received-arrow::after {
            content: '';
            width: 0;
            height: 0;
            border-left: 1vw solid transparent;
            border-right: 1vw solid transparent;
            border-top: 1vw solid grey;
            position: absolute;
            left: 0vw;
        }

        #ibp {
            background-color: whitesmoke;
            display: flex;
            flex-direction: column;
            width: 33vw;
            height: 15vh;
            border-bottom: 1px solid black;
            position: relative;
            /* overflow: hidden;
             text-overflow: ellipsis;*/
        }

        div #lastMessage {
            /*text-align:center;*/
            align-self: end;
            max-height: 2.5em;
            position: absolute;
            bottom: 0;
            width: 27vw;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #ibpName {
            top: 1vw;
            align-self: center;
            height: 10vh;
            width: 12vw;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #ibpPic {
            height: 8vh;
            width: 5vw;
            position: absolute;
            bottom: 2vw;
            margin-left: 0.5vw;
            border-radius: 5vw;
        }

        #ibpTimeSent {
            position: absolute;
            top: 0.5vw;
            right: 1vw;
        }

        #ibpUnseenMessages {
            position: absolute;
            top: 2.5vw;
            right: 1vw;
            height: 3vh;
            width: 3vw;
            background-color: black;
            color: whitesmoke;
            border-radius: 2vw;
            text-align: center;
        }

        #conversationBox {
            position: relative;
            width: 63.5vw;
            /* overflow-y: scroll;*/
        }

        #conversationFooter {
            background-color: whitesmoke;
            height: 7vh;
            width: 63vw;
            bottom: 1vw;
            text-align: center;
            position: fixed;
            right: 1vw;
        }

        #inputSection {
            right: 6vw;
            position: absolute;
            bottom: 1vw;
        }

        #ibpSection {
            overflow-y: scroll;
            position: relative;
            height: 92vh;
            background-color: #d4d4d4;

            &::-webkit-scrollbar {
                /*width: 0.5em;
                height: 0.5em;*/
            }

            &::-webkit-scrollbar-track {
                bottom: 0;
                position: absolute;

            }

            &::-webkit-scrollbar-thumb {
                background-color: rgba(255, 255, 255, .1);
                border-radius: 3px;

                &:hover {
                    /* background: rgba(255,255,255,.2);*/
                    background-color: #555;
                }
            }

        }

        #received-media-arrow::after {
            content: '';
            width: 0;
            height: 0;
            border-left: 1vw solid transparent;
            border-right: 1vw solid transparent;
            border-top: 1vw solid grey;
            position: absolute;
            left: 0vw;
        }

        #received-msg-img {
            align-self: start;
            height: 54vh;
            width: 32vw;
            background-color: grey;
            margin-left: 1vw;
            margin-top: 1vh;
            border-radius: 1vw;
        }

        #received-img {
            height: 50vh;
            width: 30vw;
            align-self: center;
            margin-left: 1vw;
            margin-top: 1vh;
            padding-bottom: 1vh;
        }

        #received-timeSent-img {
            position: relative;
            top: -3vh;
            margin-left: 1vw;
        }


        #sent-media-arrow::after {
            content: '';
            position: relative;
            width: 0;
            height: 0;
            border-left: 1vw solid transparent;
            border-right: 1vw solid transparent;
            border-top: 1vw solid grey;
            position: absolute;
            right: 0vw;
            /* top: 0.5vh;
              left: -0.6vw;*/
        }

        #sent-msg-img {
            align-self: end;
            height: 54vh;
            width: 32vw;
            background-color: grey;
            margin-right: 1vw;
            margin-top: 1vh;
            border-radius: 1vw;
        }

        #sent-img {
            height: 50vh;
            width: 30vw;
            align-self: center;
            margin-left: 1vw;
            margin-top: 1vh;
            padding-bottom: 1vh;
        }

        #sent-timeSent-img {
            position: relative;
            top: -3vh;
            margin-left: 1vw;
        }

        .logo {
            width: 2vw;
            height: 4vh;
            position: relative;
            padding-left: 1vw;
            padding-top: 1vh;
        }

        #plusLogo, #sendLogo {
            height: 4vh;
            width: 3vw;
            position: relative;
            top: 0.5vh;
        }

        #sendLogo {
            left: 1vw;
        }

        #plusLogo {
            right: 1vw;
        }

        #messageEntered {
            height: 5vh;
            width: 25vw;
            position: relative;
            top: 1.5vh;
            border-radius: 0.5vw;
        }
        #backLogo{
            height: 5vh;
            width: 5vh;
            border-radius: 0.5vw;
            position: relative;
            top:1vh;
            left:0.5vw;
        }
        #optionsLogoDiv{
            position:relative;
            left:45vw;
            align-self: end;
        }
        #optionsLogo {
            height: 5vh;
            width: 5vh;
            border-radius: 0.5vw;
            /*position: relative;
            top:1vh;
            left:0.5vw;
            align-self: flex-end;*/
        }

        /*  }*/


        @media (min-width: 0px) and (max-width: 1024px) {

            body {
                overflow-y: hidden;
            }

            #conversationContents {
                display: flex;
                flex-direction: row;
            }

            #headers {
                display: flex;
                flex-direction: row;
            }

            #ibpSectionHeader {
                position: relative;
                width: 100%;
                background-color: whitesmoke;
                margin-bottom: 0.3vh;
                z-index: 2;
            }

            #messageHeader {
                width: 100%;
                height: 6.5vh;
                background-color: whitesmoke;
                right: 1vw;
                position: fixed;
                display:flex;
                flex-direction: row;
            }

            #messageHeaderDetails{
                display: flex;
                flex-direction: row;
            }

            #messageHeaderPicDiv{
                display: flex;
                position: relative;
                height: 6vh;
                width: 5vw;
            }

            #messageHeaderPic {
                display: flex;
                position: relative;
                left: 2vw;
                top: 0.25vh;
                height: 6vh;
                width: 5vw;
                border-radius: 2vw;
            }

            #messageHeaderName {
                display: flex;
                position: relative;
                left: 30px;
                bottom: 20px;
                font-size: 30px;
                text-align: center;
                width: 10vw;
                height: 6vh;
            }

            #conversationBody {
                position: fixed;
                width: 98vw;
                height: 83vh;
                background-color: whitesmoke;
                display: flex;
                flex-direction: column;
                right: 1vw;
                overflow-y: auto;
                z-index: 1;
            }

            #myMsg {

                background-color: grey;
                display: inline-block;
                max-width: 55vw;
                margin-bottom: 10px;
                align-self: end;
                font-size: 15px;
                word-wrap: break-word;
                white-space: pre-wrap;
                border-radius: 2vw;
                padding: 1vw 1vw 1vw 1vw;
                position: relative;
                bottom: 2.2vh;
                right: 0.5vw;

            }

            #FriendMsg {
                background-color: grey;
                display: inline-block;
                max-width: 55vw;
                margin-bottom: 10px;
                align-self: start;
                font-size: 15px;
                word-wrap: break-word;
                white-space: pre-wrap;
                border-radius: 1vw;
                padding: 1vw 1vw 1vw 1vw;
                position: relative;
                left: 0.5vw;
                bottom: 2.2vh;
            }

            #sent-arrow {
                align-self: end;
            }

            #sent-arrow::after {
                content: '';
                position: relative;
                width: 0;
                height: 0;
                border-left: 1vw solid transparent;
                border-right: 1vw solid transparent;
                border-top: 1vw solid grey;
                position: absolute;
                right: 0vw;

            }

            #received-arrow {
                align-self: start;

            }

            #sent-msg {
                align-self: end;
            }

            #received-msg {
                align-self: start;
            }

            #received-arrow::after {
                content: '';
                width: 0;
                height: 0;
                border-left: 1vw solid transparent;
                border-right: 1vw solid transparent;
                border-top: 1vw solid grey;
                position: absolute;
                left: 0vw;
            }

            #ibp {
                background-color: whitesmoke;
                display: flex;
                flex-direction: column;

                width: 98vw;
                height: 15vh;
                border-bottom: 1px solid black;
                position: relative;

            }

            div #lastMessage {

                align-self: end;
                max-height: 2.5em;
                position: absolute;
                bottom: 0;
                width: 27vw;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            #ibpName {
                top: 1vw;
                align-self: center;
                height: 10vh;
                width: 12vw;
                font-weight: bold;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            #ibpPic {
                height: 8vh;
                width: 5vw;
                position: absolute;
                bottom: 2vw;
                margin-left: 0.5vw;
                border-radius: 5vw;
            }

            #ibpTimeSent {
                position: absolute;
                top: 0.5vw;
                right: 1vw;
            }

            #ibpUnseenMessages {
                position: absolute;
                top: 2.5vw;
                right: 1vw;
                height: 3vh;
                width: 3vw;
                background-color: black;
                color: whitesmoke;
                border-radius: 2vw;
                text-align: center;
            }

            #conversationBox {
                position: relative;
                z-index: 1;
                width: 100%;

            }

            #conversationFooter {
                background-color: whitesmoke;
                height: 7vh;
                width: 63vw;
                bottom: 1vw;
                text-align: center;
                position: fixed;
                right: 1vw;
            }

            #inputSection {
                right: 6vw;
                position: absolute;
                bottom: 1vw;
            }

            #ibpSection {
                overflow-y: visible;
                position: relative;
                height: 92vh;
                width: 100%;
                z-index: 2;

                &::-webkit-scrollbar {

                }

                &::-webkit-scrollbar-track {
                    bottom: 0;
                    position: absolute;

                }

                &::-webkit-scrollbar-thumb {
                    background-color: rgba(255, 255, 255, .1);
                    border-radius: 3px;

                    &:hover {

                        background-color: #555;
                    }
                }

            }

            #received-media-arrow::after {
                content: '';
                width: 0;
                height: 0;
                border-left: 1vw solid transparent;
                border-right: 1vw solid transparent;
                border-top: 1vw solid grey;
                position: absolute;
                left: 0vw;
            }

            #received-msg-img {
                align-self: start;
                height: 35vh;
                width: 50vw;
                background-color: grey;
                margin-left: 1vw;
                border-radius: 1vw;
                margin-bottom: 10px;
            }

            #received-img {
                height: 30vh;
                width: 47vw;
                align-self: center;
                margin-left: 1.5vw;
                margin-top: 1vh;
                padding-bottom: 1vh;
            }


            #sent-media-arrow::after {
                content: '';
                position: relative;
                width: 0;
                height: 0;
                border-left: 1vw solid transparent;
                border-right: 1vw solid transparent;
                border-top: 1vw solid grey;
                position: absolute;
                right: 0vw;
            }

            #sent-msg-img {
                align-self: end;
                height: 35vh;
                width: 50vw;
                background-color: grey;
                margin-right: 1vw;
                border-radius: 1vw;
                margin-bottom: 10px;
            }

            #sent-img {
                height: 30vh;
                width: 47vw;
                align-self: center;
                margin-left: 1.5vw;
                margin-top: 1vh;
                padding-bottom: 1vh;
            }

            .logo {
                width: 2vw;
                height: 4vh;
                position: relative;
                padding-left: 1vw;
                padding-top: 1vh;
            }

            #plusLogo, #sendLogo {
                height: 4vh;
                width: 3vw;
                position: relative;
                top: 0.5vh;
            }

            #sendLogo {
                left: 1vw;
            }

            #plusLogo {
                right: 1vw;
            }

            #messageEntered {
                height: 5vh;
                width: 25vw;
                position: relative;
                top: 1.5vh;
                border-radius: 0.5vw;
            }

            #backLogo{
                height: 5vh;
                width: 5vh;
                border-radius: 0.5vw;
                position: relative;
                top:1vh;
                left:0.5vw;
            }
          /*  #optionsLogoDiv{
                position:relative;
                left:70vw;
                align-self: end;
            }
            #optionsLogo {
                height: 5vh;
                width: 5vh;
                border-radius: 0.5vw;
            }*/

        }

       @media (min-width: 501px) and (max-width: 1024px){
            #sent-timeSent-img {
                position: relative;
                margin-left: 1vw;
                font-size: 2.5vw;
                margin-top: 2vh;
            }

            #received-timeSent-img {
                position: relative;
                margin-left: 1vw;
                font-size: 2.5vw;
                margin-top: 2vh;
            }

            #optionsLogoDiv{
                position:relative;
                left:70vw;
                align-self: end;
                background-color: blue;
            }
            #optionsLogo {
                height: 5vh;
                width: 5vh;
                border-radius: 0.5vw;
            }
        }

        @media (min-width: 1px) and (max-width: 500px){
            #sent-timeSent-img {
                position: relative;
                top: -3vh;
                margin-left: 2vw;
                font-size: 20px;
                margin-top: 2.5vh;
            }
            #received-timeSent-img {
                position: relative;
                top: -3vh;
                margin-left: 2vw;
                font-size: 20px;
                margin-top: 2.5vh;
            }
            #optionsLogoDiv{
                position:relative;
                left:60vw;
                align-self: end;
                background-color: red;
            }
            #optionsLogo {
                height: 5vh;
                width: 5vh;
                border-radius: 0.5vw;
            }
        }

    </style>
    <title><?php
        global $pageTitle;
        global $user;
        global $otherUserId;
        //$otherUser=$otherUserId;
        $userId = $user->getId();
        echo $pageTitle; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body onload="">
<div id="headers">
    <div id="ibpSectionHeader">
        <a
            <?php
            $action = "";
            if ($user->getUserType() == 1) {
                $action = "show_clientHome";
            } else if ($user->getUserType() == 2) {
                $action = "show_workerHome";
            }
            ?>
                href="../Controller/index.php?action=<?php echo $action; ?>"
        ><img src="../logo/home.png" alt="" class="logo"> </a>
    </div>
    <div id="messageHeader">
        <div id="backLogoDiv">

        </div>
        <div id="messageHeaderDetails">

        </div>
        <div id="optionsLogoDiv">

        </div>
    </div>
</div>

<div id="conversationContents">
    <div id="ibpSection">

    </div>
    <div id="conversationBox">
        <div id="conversationBody">

        </div>

        <div id="conversationFooter">
            <div id="inputSection">
                <input type="file" id="messageFile">
                <img id="plusLogo" src="../logo/plus.png" onclick="selectFile()">
                <textarea id="messageEntered"></textarea>
                <img id="sendLogo" src="../logo/send.png" onclick="sendMessage()">
            </div>
        </div>

    </div>
</div>
</body>
<script>

    var mainInboxId = 0;
    var otherUserId = <?php echo $otherUserId ?>;
    //alert(otherUserId);
    var convoBody = document.getElementById("conversationBody");
    document.getElementById("messageFile").hidden = true;
    var convoBodyHeight = 0;
    var height = 0;
    var fetched = false;
    setInterval(getIbps, 2000);
    setInterval(refresh, 2000);

    function refresh() {
        if (mainInboxId != 0) {
            setInterval(getNewMessages, 2000);
            //setInterval(getPreviousMessages, 2000);
        } else if (otherUserId != 0) {
            getInboxId();
        }
    }

    async function sendMessage() {
        var msg = document.getElementById("messageEntered").value.trim();
        var msgFile = document.getElementById("messageFile");
        if (msg !== "" && msg !== null) {
            if (mainInboxId != 0) {
                $(document).ready(function () {
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "send_Message", "inboxId": mainInboxId, "message": msg},
                        success: function (data) {
                            // alert(data);
                        },
                        error: function () {
                            alert("Error with ajax");
                        }
                    });
                });


            } else if (otherUserId != 0) {
                $(document).ready(function () {
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "send_First_Message", "userId": otherUserId, "message": msg},
                        success: function (data) {
                            //  alert(data);
                            if (data != 0) {
                                getMessages(data)
                                otherUserId = 0;
                                mainInboxId = data;
                            }
                        },
                        error: function () {
                            alert("Error with ajax");
                        }
                    });
                });
            }

        } else if (msgFile.value != "") {
            var formData = new FormData();
            var extension = msgFile.value.split(".").pop();
            if (mainInboxId === 0 && otherUserId !== 0) {
                formData.append("action", "send_First_File");
                formData.append("userId", otherUserId);
            } else if (mainInboxId != 0 && otherUserId == 0) {
                formData.append("action", "send_File");
                formData.append("inboxId", mainInboxId);
            }
            formData.append("file", msgFile.files[0]);
            formData.append("extension", extension);

            var response = await fetch('../Controller/index.php', {
                    method: "POST",
                    body: formData
                })
                /* .then(data => {
                     alert(data.body); // Handle your response here
                 })
*/
            ;
            // Check if the request was successful (status code 200)
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Parse the response body if it's JSON (or text if it's not)
            //const data = await response.json(); // or response.text() for text responses

            //console.log(response);
            msgFile.value = "";
        }
    }

    function getMessages(inboxId) {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_Messages", "inboxId": inboxId},
                success: function (data) {
                    generateLogo(inboxId);
                    getMessageHeader(inboxId, 0);
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        if (allMessages[i][2] ==<?php echo $userId ?>) {
                            if (allMessages[i][4] == 1) {
                                messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                            } else if (allMessages[i][4] == 2) {
                                messages += "<div id='sent-msg-img'>  <div class='' id='sent-media-arrow'>  </div> <img src='../messageImages/" + allMessages[i][3] + "' id='sent-img'>     <p id='sent-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            } else if (allMessages[i][4] == 3) {
                                messages += "<div id='sent-msg-img'>  <div class='' id='sent-media-arrow'>  </div>  <video id='sent-img' controls> <source src='../messageVideos/" + allMessages[i][3] + "'> </video>   <p id='sent-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            }

                        } else {
                            if (allMessages[i][4] == 1) {
                                messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                            } else if (allMessages[i][4] == 2) {
                                messages += "<div id='received-msg-img'>  <div class='' id='received-media-arrow'>  </div> <img src='../messageImages/" + allMessages[i][3] + "' id='received-img'>     <p id='received-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            } else if (allMessages[i][4] == 3) {
                                messages += "<div id='received-msg-img'>  <div class='' id='received-media-arrow'>  </div>  <video id='received-img' controls> <source src='../messageVideos/" + allMessages[i][3] + "'> </video>   <p id='received-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            }
                        }
                    }
                    mainInboxId = inboxId;
                    document.getElementById("conversationBody").innerHTML = messages
                    screenResize();
                    convoBody.scrollTop = convoBody.scrollHeight;
                    convoBodyHeight = convoBody.scrollHeight;
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }
    
    function generateLogo(inboxId){
        document.getElementById("optionsLogoDiv").innerHTML=" <img id='optionsLogo' src='../logo/options.png' alt=''>"
        document.getElementById("inputSection").style.display="block";
        if(window.innerWidth >= 320 && window.innerWidth < 1025){
            document.getElementById("backLogoDiv").innerHTML= " <img id='backLogo' src='../logo/back.png' alt='' onclick='showIbps()' >";
        }
    }
    function showIbps(){
        closPreviousIbp();
        mainInboxId=0;
        otherUserId=0;
        screenResize();
        clearMessageDetails();
    }

    function clearMessageDetails(){
        document.getElementById("backLogoDiv").innerHTML= "";
        document.getElementById("optionsLogoDiv").innerHTML=""
        document.getElementById("messageHeaderDetails").innerHTML="";
        document.getElementById("conversationBody").innerHTML="";
        document.getElementById("inputSection").style.display="none";
    }

    function getMessageHeader(inboxId, userId) {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "getMessageHeader", "inboxId": inboxId, "userId": userId},
                success: function (data) {
                    var header = "";
                    //alert(data);
                    var details = JSON.parse(data);

                    var profilePic = "../defaultPic/default.jpg";
                    var pic = details[1];
                    if (pic != "" && pic != null) {
                        profilePic = "../profilePics/" + details[1];
                    }
                    header = " <div id='messageHeaderPicDiv'> <img id='messageHeaderPic' src='" + profilePic + "'> </div> <div id='messageHeaderName'> <p>" + details[0] + "</p> </div> ";
                    document.getElementById("messageHeaderDetails").innerHTML = header;
                    //alert(header[0] );
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    function getNewMessages() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_New_Messages", "inboxId": mainInboxId},
                success: function (data) {
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        if (allMessages[i][2] ==<?php echo $userId ?>) {
                            if (allMessages[i][4] == 1) {
                                messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                            } else if (allMessages[i][4] == 2) {
                                messages += "<div id='sent-msg-img'>  <div class='' id='sent-media-arrow'>  </div> <img src='../messageImages/" + allMessages[i][3] + "' id='sent-img'>     <p id='sent-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            }
                        } else {
                            if (allMessages[i][4] == 1) {
                                messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                            } else if (allMessages[i][4] == 2) {
                                messages += "<div id='received-msg-img'>  <div class='' id='received-media-arrow'>  </div> <img src='../messageImages/" + allMessages[i][3] + "' id='received-img'>     <p id='received-timeSent-img' >" + allMessages[i][5] + "</p>  </div>";
                            }
                        }
                    }
                    if (allMessages.length > 0) {
                        document.getElementById("conversationBody").innerHTML += messages
                    }

                    /*convoBody.scrollTop = convoBody.scrollHeight;
                    convoBodyHeight = convoBody.scrollHeight;*/
                },
                error: function () {
                    // alert("Error with ajax");
                    console.log("error in ajax");
                }
            });
        });

    }

    async function getPreviousMessages() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_Previous_Messages", "inboxId": mainInboxId},
                success: function (data) {
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        fetched = true;
                        if (allMessages[i][2] ==<?php echo $userId ?>) {
                            messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                        } else {
                            messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                        }
                    }
                    //var temp=document.getElementById("conversationBody").innerHTML;
                    document.getElementById("conversationBody").innerHTML = messages + document.getElementById("conversationBody").innerHTML;
                    convoBody.scrollTop = convoBody.scrollHeight - convoBodyHeight;
                    //alert(fetched);
                    /*  height= convoBody.scrollHeight;
                    document.getElementById("conversationBody").innerHTML += temp;*/

                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    function getIbps() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_ibps"},
                success: function (data) {
                    //alert(data);
                    var allIbps = JSON.parse(data);
                    var ibps = "";

                    for (var i = 0; i < allIbps.length; i++) {
                        var profilePic = "../defaultPic/default.jpg";
                        var pic = allIbps[i][5];
                        if (pic != "" && pic != null) {
                            profilePic = "../profilePics/" + allIbps[i][5];
                        }
                        if (allIbps[i][2] > 0) {
                            ibps = ibps + " <div id='ibp' onclick='getMessages(" + allIbps[i][0] + ")' > <div><img id='ibpPic' src='" + profilePic + "'></div>  <div id='ibpName'><p>" + allIbps[i][4] + "</p></div><p id='lastMessage'>" + allIbps[i][3] + "</p><div id='ibpTimeSent'><p>" + allIbps[i][1] + "</p></div> <div id=''><p id='ibpUnseenMessages'>" + allIbps[i][2] + "</p></div> </div>"
                        } else {
                            ibps = ibps + " <div id='ibp' onclick='getMessages(" + allIbps[i][0] + ")' > <div><img id='ibpPic' src='" + profilePic + "'></div>  <div id='ibpName'><p>" + allIbps[i][4] + "</p></div><p id='lastMessage'>" + allIbps[i][3] + "</p><div id='ibpTimeSent'><p>" + allIbps[i][1] + "</p></div></div>"
                        }
                        //alert(allIbps[i][5]);
                        //console.log(allIbps[i][5]);
                    }
                    if (allIbps.length > 0) {
                        document.getElementById("ibpSection").innerHTML = ibps;
                    }
                },
                error: function () {
                    // alert("Error with ajax");
                    console.log("error in ajax");
                }
            });
        });

    }

    function getInboxId() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_inboxId", "userId": otherUserId},
                success: function (data) {
                    if (data != 0) {
                        //alert(data);
                        getMessages(data);
                        otherUserId = 0;
                        mainInboxId = data;
                    } else {
                        getMessageHeader(0, otherUserId);
                        document.getElementById("conversationBody").innerHTML = "";
                    }

                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    function closPreviousIbp() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "close_Previous_Ibp"},
                success: function (data) {


                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    //when the user scrolls
    convoBody.addEventListener('scroll', (event) => {
        //set current scroll height to current scroll height
        // convoBodyHeight = convoBody.scrollTop;
        convoBodyHeight = convoBody.scrollHeight;
        //alert(convoBodyHeight);
        if (convoBody.scrollTop == 0) {
            //alert("hey")
            getPreviousMessages();
            //alert(height);
            //var height = document.getElementById("conversationBody");
            // alert(height.scrollHeight);
            // alert(fetched);
            //if(fetched==true){
            // convoBody.scrollTop=convoBodyHeight;
            //}

            // convoBodyHeight= convoBody.scrollHeight;
            //fetched=false;
        }

    });


    /* window.addEventListener('beforeunload', (event) => {
         // Optional: prompt the user (some browsers ignore this)
         event.preventDefault();
         //   event.returnValue = ''; // Required for Chrome to show the prompt
     });*/

    window.addEventListener('unload', () => {
        // Perform cleanup or send signal to server
        //alert('Window is being closed or refreshed');
        navigator.sendBeacon('../Controller/index.php?action=close_Previous_Ibp');
    });


    function selectFile() {
        document.getElementById("messageFile").click();
    }

    window.addEventListener('load', () => {
        if (window.innerWidth >= 0 && window.innerWidth < 1025) {
            if (mainInboxId == 0 && otherUserId == 0) {
                document.getElementById("conversationBox").style.display = "none";
            } else {

            }
        }
        screenResize();
    });

    function screenResize() {
        var ibpSectionHeader = document.getElementById("ibpSectionHeader");
        var ibpSection = document.getElementById("ibpSection");
        var messageHeader = document.getElementById("messageHeader");
        var conversationBox = document.getElementById("conversationBox");
        var backLogoDiv =  document.getElementById("backLogoDiv");
        if (window.innerWidth >= 0 && window.innerWidth < 1025) {
            if (mainInboxId == 0 && otherUserId == 0) {
                ibpSectionHeader.style.zIndex = '2';
                ibpSection.style.zIndex = '2';
                messageHeader.style.zIndex = '1';
                conversationBox.style.zIndex = '1';
            } else {
                backLogoDiv.innerHTML= " <img id='backLogo' src='../logo/back.png' alt='' onclick='showIbps()' >";
                conversationBox.style.display = "block";
                ibpSectionHeader.style.zIndex = '1';
                ibpSection.style.zIndex = '1';
                messageHeader.style.zIndex = '2';
                messageHeader.style.width = '98vw';
                conversationBox.style.zIndex = '2';
                conversationBox.style.width = '98vw';
                conversationBox.style.overflowY = 'visible';

            }
        } else if(window.innerWidth > 1024) {
            conversationBox.style.display = "block";
            backLogoDiv.innerHTML= "";
            if (mainInboxId == 0 && otherUserId == 0) {
                ibpSectionHeader.style.zIndex = '1';
                ibpSection.style.zIndex = '1';
                messageHeader.style.zIndex = '1';
                messageHeader.style.width = '63.5vw';
                conversationBox.style.zIndex = '1';
                conversationBox.style.width = '63.5vw';
                conversationBox.style.overflowY = 'visible';

            } else {
                ibpSectionHeader.style.zIndex = '1';
                ibpSection.style.zIndex = '1';
                messageHeader.style.zIndex = '1';
                messageHeader.style.width = '63.5vw';
                conversationBox.style.zIndex = '1';
                conversationBox.style.width = '63.5vw';
                conversationBox.style.overflowY = 'visible';

            }
        }
    }

    window.addEventListener('resize', () => {
        screenResize();

    });
</script>

</html>




