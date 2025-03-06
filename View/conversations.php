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
        }

        #messageHeaderPic {
            position: relative;
            left: 1vw;
            top: 0.25vh;
            height: 6vh;
            width: 3vw;
            border-radius: 2vw;
        }

        #messageHeaderName {
            position: absolute;
            left: 3vw;
            bottom: 1vw;
            font-size: 1.8vw;
            text-align: center;
            width: 10vw;
            height: 6vh;
        }

        #conversationBody {
            position: relative;
            width: 63.5vw;
            height: 83vh;
            background-color: whitesmoke;
            display: flex;
            flex-direction: column;
            left: 1vw;
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


<body onload="">
<div id="headers">
    <div id="ibpSectionHeader">
<button onclick="">Home</button>
    </div>
    <div id="messageHeader">
        <div id="messageHeaderDetails">
        <div id="">
            <img id="messageHeaderPic" src="../defaultPic/default.jpg">
        </div>
        <div id="messageHeaderName">
            <p> Craic </p>
        </div>
        </div>
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
            <div id="sent-msg">
                <div class="" id="sent-arrow">
                    <p id="myMsg">hellojdjdndndndndnndndn </p>
                </div>
            </div>
            <div id="received-msg">
                <div class="" id="received-arrow">
                    <p id="FriendMsg">hi carl</p>
                </div>
            </div>
            <div id="sent-msg">
                <div class="" id="sent-arrow">
                    <p id="myMsg">hellojdjdndndndndnndndn jjsjskksnmddkdldlllllllllllllllllllllllllllllllllllm
                        dmmdmdddhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>
                </div>
            </div>
            <div id="sent-msg">
                <div class="" id="sent-arrow">
                    <p id="myMsg">hellojdjdndndndndnndndn hjhhh jjsjskksnmddkdldlllllllllllllllllllllllllllllllllllm
                        dmmdmdddhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>
                </div>
            </div>
            <div id="received-msg">
                <div class="" id="received-arrow">
                    <p id="FriendMsg">hi carl</p>
                </div>
            </div>
            <div id="sent-msg">
                <div class="" id="sent-arrow">
                    <p id="myMsg">hellojdjdndndndndnndndn</p>
                </div>
            </div>
            <div id="received-msg">
                <div class="" id="received-arrow">
                    <p id="FriendMsg">hi carl nnnnnnnnnnnnnnnnnnndjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj
                        dnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnj hdhhhhhhhhhhhhhhhhhhhhhh
                        hddddddddddddddddd hddddddddddddddddddddddd hhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>
                </div>
            </div>

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
    var convoBody = document.getElementById("conversationBody");
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
                    getMessageHeader(inboxId,0);
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        if (allMessages[i][2] ==<?php echo $userId ?>) {
                            messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                        } else {
                            messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                        }
                    }
                    mainInboxId = inboxId;
                    document.getElementById("conversationBody").innerHTML = messages
                    convoBody.scrollTop = convoBody.scrollHeight;
                    convoBodyHeight = convoBody.scrollHeight
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

     function getMessageHeader(inboxId, userId) {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "getMessageHeader", "inboxId": inboxId, "userId": userId},
                success: function (data) {
                    var header="";
                    var details = JSON.parse(data);

                var profilePic = "../defaultPic/default.jpg";
                var pic = details[1];
                if (pic != "" && pic != null) {
                    profilePic = "../profilePics/" + details[1];
                }
                    header=" <div id=''> <img id='messageHeaderPic' src='"+ profilePic+"'> </div> <div id='messageHeaderName'> <p>" + details[0] +"</p> </div> </div>";
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
                            messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                        } else {
                            messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                        }
                    }
                    document.getElementById("conversationBody").innerHTML += messages

                    /*convoBody.scrollTop = convoBody.scrollHeight;
                    convoBodyHeight = convoBody.scrollHeight;*/
                },
                error: function () {
                    alert("Error with ajax");
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
                        }
                        else{
                            ibps = ibps + " <div id='ibp' onclick='getMessages(" + allIbps[i][0] + ")' > <div><img id='ibpPic' src='" + profilePic + "'></div>  <div id='ibpName'><p>" + allIbps[i][4] + "</p></div><p id='lastMessage'>" + allIbps[i][3] + "</p><div id='ibpTimeSent'><p>" + allIbps[i][1] + "</p></div></div>"
                        }
                        //alert(allIbps[i][5]);
                        //console.log(allIbps[i][5]);
                    }
                    document.getElementById("ibpSection").innerHTML = ibps
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

</script>

</html>




