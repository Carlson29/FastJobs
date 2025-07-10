var mainInboxId = 0;
    var otherUserId = <?php echo $otherUserId ?>;
    //alert(otherUserId);
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
                    getMessageHeader(inboxId,0);
                    //alert(data);
                    var allMessages = JSON.parse(data);
                    var messages = "";
                    for (var i = allMessages.length - 1; i >= 0; i--) {
                        if (allMessages[i][2] ==<?php echo $userId ?>) {
                             if(allMessages[i][4]==1) {
                                 messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                             }
                             else if(allMessages[i][4]==2) {
                             messages += "<div id='sent-msg-img'>  <div class='' id='sent-media-arrow'>  </div> <img src='../messageImages/"+ allMessages[i][3]+"' id='sent-img'>     <p id='sent-timeSent-img' >" +allMessages[i][5] +"</p>  </div>";
                             }

                        } else {
                            if(allMessages[i][4]==1) {
                                messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                            }
                            else if(allMessages[i][4]==2) {
                                messages += "<div id='received-msg-img'>  <div class='' id='received-media-arrow'>  </div> <img src='../messageImages/"+ allMessages[i][3]+"' id='received-img'>     <p id='received-timeSent-img' >" +allMessages[i][5] +"</p>  </div>";
                            }
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
                    //alert(data);
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
                            if(allMessages[i][4]==1) {
                                messages = messages + "<div id='sent-msg'><div class='' id='sent-arrow'> <p id='myMsg'>" + allMessages[i][3] + "</p>  </div> </div>";
                            }
                            else if(allMessages[i][4]==2) {
                                messages += "<div id='sent-msg-img'>  <div class='' id='sent-media-arrow'>  </div> <img src='../messageImages/"+ allMessages[i][3]+"' id='sent-img'>     <p id='sent-timeSent-img' >" +allMessages[i][5] +"</p>  </div>";
                            }
                        } else {
                            if(allMessages[i][4]==1) {
                                messages = messages + "<div id='received-msg'>  <div class='' id='received-arrow'>  <p id='FriendMsg'>" + allMessages[i][3] + "</p> </div></div>";
                            }
                            else if(allMessages[i][4]==2) {
                                messages += "<div id='received-msg-img'>  <div class='' id='received-media-arrow'>  </div> <img src='../messageImages/"+ allMessages[i][3]+"' id='received-img'>     <p id='received-timeSent-img' >" +allMessages[i][5] +"</p>  </div>";
                            }
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
                    if(allIbps.length > 0){
                        document.getElementById("ibpSection").innerHTML = ibps;
                    }
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
                    else{
                        getMessageHeader(0,otherUserId);
                        document.getElementById("conversationBody").innerHTML ="";
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