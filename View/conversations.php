<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title><?php
        global $pageTitle;
        global $user;
        $userId = $user->getId();
        echo $pageTitle; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body>
<div id="inboxSection">
    <button onclick="getMessages(1)"> show messages</button>
</div>
<div id="conversationBox">
    <div id="conversationBody">

    </div>

    <div>
        <input type="text" id="messageEntered">
        <button onclick="sendMessage()"> send message</button>
    </div>

</div>
</body>
<script>
    var mainInboxId = 0;
    var otherUserId = 0;
    setInterval(getIbps, 2000);
    setInterval(refresh, 2000);

    function refresh() {
        if (mainInboxId != 0) {
            setInterval(getNewMessages, 2000);
            //setInterval(getPreviousMessages, 2000);
        }
    }

    function sendMessage() {
        var msg = document.getElementById("messageEntered").value.trim();
        if(mainInboxId!=0) {
            if (msg !== "" && msg !== null) {

                $(document).ready(function () {
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "send_Message", "inboxId": mainInboxId, "message": msg},
                        success: function (data) {
                            //alert(data);
                        },
                        error: function () {
                            alert("Error with ajax");
                        }
                    });
                });

            }
        }
        else{
            otherUserId=2
            if (msg !== "" && msg !== null) {

                $(document).ready(function () {
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "send_First_Message", "userId": otherUserId, "message": msg},
                        success: function (data) {
                            //alert(data);
                        },
                        error: function () {
                            alert("Error with ajax");
                        }
                    });
                });

            }
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
                    document.getElementById("conversationBody").innerHTML = messages +document.getElementById("conversationBody").innerHTML;
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

</script>

</html>




