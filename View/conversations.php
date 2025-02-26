<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <style>
        body {
        overflow-y: hidden;
        }

        #conversationContents {
            display: flex;
            flex-direction: row;
        }

        #ibpSectionHeader {
            position: relative;
            width: 33vw;
            height: 5vh;
            background-color: whitesmoke;
            margin-bottom: 0.5vh;
        }
        #messageHeader{

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

    </style>
    <title><?php
        global $pageTitle;
        global $user;
        $userId = $user->getId();
        echo $pageTitle; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body>
<div id="headers">
<div id="ibpSectionHeader">

</div>
<div id="messageHeader">

</div>
</div>
<div id="conversationContents">
    <div id="ibpSection">
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">hey</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
        <div id="ibp">
            <div><img id="ibpPic" src="../defaultPic/default.jpg"></div>
            <div id="ibpName"><p>Craic</p></div>
            <p id="lastMessage">heyyyyyyyyyyyyyyyyyyyyyyyy yyyyyyy
                yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy</p>
            <div id="ibpTimeSent"><p>19:56</p></div>
            <div id=""><p id="ibpUnseenMessages">1</p></div>
        </div>
    </div>
    <div id="conversationBox">
        <div id="conversationBody">
        </div>

        <div id="conversationFooter">
            <div id="inputSection">
                <input type="file" id="messageFile">
                <input type="text" id="messageEntered">
                <button onclick="sendMessage()"> send message</button>
            </div>
        </div>

    </div>
</div>
</body>
<script>
    var mainInboxId = 0;
    var otherUserId = 0;
    //setInterval(getIbps, 2000);
    //setInterval(refresh, 2000);

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
                            alert(data);
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
                // throw new Error('Network response was not ok');
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
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        if (allMessages[i][3] ==<?php echo $userId ?>) {
                            messages = messages + "<div id='myMessage'><p>" + allMessages[i][3] + "</p></div>";
                        } else {
                            messages = messages + "<div id='friendMessage'><p>" + allMessages[i][3] + "</p></div>";
                        }
                    }
                    mainInboxId = inboxId;
                    document.getElementById("conversationBody").innerHTML = messages
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
                        if (allMessages[i][3] ==<?php echo $userId ?>) {
                            messages = messages + "<div id='myMessage'><p>" + allMessages[i][3] + "</p></div>";
                        } else {
                            messages = messages + "<div id='friendMessage'><p>" + allMessages[i][3] + "</p></div>";
                        }
                    }
                    document.getElementById("conversationBody").innerHTML += messages
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    function getPreviousMessages() {
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
                        if (allMessages[i][3] ==<?php echo $userId ?>) {
                            messages = messages + "<div id='myMessage'><p>" + allMessages[i][3] + "</p></div>";
                        } else {
                            messages = messages + "<div id='friendMessage'><p>" + allMessages[i][3] + "</p></div>";
                        }
                    }
                    document.getElementById("conversationBody").innerHTML = messages + document.getElementById("conversationBody").innerHTML;
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

                        ibps = ibps + "<button onclick='getMessages(" + allIbps[i][0] + ")'> " + allIbps[i][4] + "</button>";
                    }
                    document.getElementById("inboxSection").innerHTML = ibps
                },
                error: function () {
                    alert("Error with ajax");
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
                    }

                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

</script>

</html>




