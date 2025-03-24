<?php
include 'header.php';
?>
    <style>
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

        #workers {
            display: flex;
            flex-direction: row;
            position: relative;
            height: 100%;
            flex-wrap: wrap;
        }

        #worker {
            /* border: 2px solid black;*/
            /*!* border-radius: 1vw;*!*/
            /* background-color: #666666;*/
            /* height: 25vh;*/
            /* width:23vw;*/
            /*margin-left: 1vw;*/
            /* margin-top: 1vh;*/
            /* display: flex;*/
            /* flex-direction: row;*/
            /* position: relative;*/
            /* overflow: hidden;*/
            /*resize: horizontal;*/
            background-color: #666666;
            height: 25vh;
            width: 23vw;
            display: flex;
            flex-direction: row;
            margin-top: 1vh;
            margin-left: 1vw;
            border: 2px solid black;
            border-radius: 1vw;
            left: 0;
        }

        #workername {

            /*            overflow-x: hidden;*/
            /*            white-space: nowrap;*/
            /*            text-overflow: ellipsis;*/
            /*left: 11vw;*/
            /*            width: 11vw;*/
            /*            position: relative;*/


            /* position: absolute;
           max-height: 3vh;
           overflow: hidden;
          max-width: 20vw;
           max-height: 20vw
           max-height: 4vh;
           overflow: hidden;
           text-overflow: ellipsis;*/

            max-height: 20vw
            max-height: 3vh;
            display: -webkit-box; /* For multi-line truncation */
            -webkit-line-clamp: 3; /* Limit the text to 2 lines */
            -webkit-box-orient: vertical; /* Required for -webkit-line-clamp */
            line-height: 1.5em;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 18px;
        }

        #message {
            /*width:4vw;*/
            /*height:3vh;*/
            /*position:relative;*/
            /*text-align: right;*/
            /*margin-left: 18vw;*/

            /* height:10vh;
             viewBox: 0 0 16 16;*/

            width: 4vw;
            height: 3vh;
            position: absolute;
            align-self: end;

        }

        #workerPicture {
            /*   !* right:0;*/
            /*   position: absolute;*/
            /*text-align: left;*!*/
            /*   position: absolute;*/
            /*   display: flex;*/
            /*   flex-direction: row;*/
            /* !*left: -1vw;*!*/
            /*  width:13vw;*/
            /*   height:25vh;*/
            width: 13vw;
            height: 25vh;
            border-radius: 1vw;
        }

        #workerPictureDiv {
            /* position: absolute;
             text-align: left;
             left: -2vw;*/
            /*position: relative;*/
            /*width:15vw;*/
            /*height:25vh;*/
            /*overflow: hidden;*/
            /*display: flex;*/
            /*flex-direction: row;*/
        }

        #distanceAway {
            position: relative;
            margin-top: 3vh;
        }
    </style>
    <body onload="getLocation()" id="main" >
    <div id="sidebar">
        <div id="mySidenav" class="sidenav">
            <a href="" class="closebtn" onclick="closeNav()">&times;</a>

            <a href="../Controller/index.php?action=show_conversations" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                    <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                </svg>
                chats </a>
            <a href="" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
                profile</a>
            <a href="" class="button">offers</a>
        </div>

    </div>

    <div id="searchBar"><input placeholder="Search" id="search">
    <div id="suggestions"></div>
    </div>
    <div id="workers">

        <div id='worker' class=''>
            <div id='workerPictureDiv' class='container-fluid'><img id='workerPicture' class='container-fluid'
                                                                    src='../defaultPic/default.jpg' alt='workers image'
                                                                    onclick='showProfilePic()'></div>
            <div id='details'>
                <div id="workername"><a class='workername'> Punch jdhhdjj jjjjjjjjjjjjjjjjjjj hnunk h mmmmbkbk
                        hjjjjjjjjjjjj</a></div>
                <div><a class='message' href=''>
                        <svg xmlns='http://www.w3.org/2000/svg' id="message" class='' viewBox="0 0 16 16">
                            <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
                        </svg>
                    </a></div>
                <p id="distanceAway"> 5km away</p></div>
        </div>

        <div id='worker' class=''>
            <div id='workerPictureDiv' class='container-fluid'><img id='workerPicture' class='container-fluid'
                                                                    src='../defaultPic/default.jpg' alt='workers image'
                                                                    onclick='showProfilePic()'></div>
            <div id='details'>
                <div id="workername"><a class='workername'> Punch jdhhdjj jjjjjjjjjjjjjjjjjjj hnunk h mmmmbkbk
                        hjjjjjjjjjjjj</a></div>
                <div><a class='message' href=''>
                        <svg xmlns='http://www.w3.org/2000/svg' id="message" class='' viewBox="0 0 16 16">
                            <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
                        </svg>
                    </a></div>
            </div>
        </div>
        <div id='worker' class=''>
            <div id='workerPictureDiv' class='container-fluid'><img id='workerPicture' class='container-fluid'
                                                                    src='../defaultPic/default.jpg' alt='workers image'
                                                                    onclick='showProfilePic()'></div>
            <div id='details'>
                <div id="workername"><a class='workername'> Punch</a></div>
                <div><a class='message' href=''>
                        <svg xmlns='http://www.w3.org/2000/svg' id="message" class='' viewBox="0 0 16 16">
                            <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
                        </svg>
                    </a></div>
            </div>
        </div>

        <div id='worker' class=''>
            <div id='details'><a class='workername' href=''> Punch"</a>"
                . "<a class='message' href=''>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                         class='bi bi-chat-right-text-fill' viewBox='0 0 16 16'>
                        <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
                    </svg>
                </a></div>
            <div id='image' class='container-fluid'><img id='pictures' class='container-fluid' src='"'
                                                         alt='workers image' onclick='showProfilePic()'></div>
        </div>
        <div id='worker' class=''>
            <div id='details'><a class='workername' href=''> Punch"</a>"
                . "<a class='message' href=''>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                         class='bi bi-chat-right-text-fill' viewBox='0 0 16 16'>
                        <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/>
                    </svg>
                </a></div>
            <div id='image' class='container-fluid'><img id='pictures' class='container-fluid' src='"'
                                                         alt='workers image' onclick='showProfilePic()'></div>
        </div>
    </div>


    </body>
    <script>
     //   setInterval(getUsersByLocation, 2000);
        function openNav() {
            document.getElementById("mySidenav").style.width = "4vw";
            document.getElementById("main").style.marginLeft = "4vw";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginRight = "0";
        }

        function getLocation() {
            closeNav();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition); // showPosition is the function that will handle the location data

                function showPosition(position) {

                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    //alert("Latitude: " + latitude + "Longitude: " + longitude);
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "store_Location", "latitude": latitude, "longitude": longitude},
                        success: function (data) {
                            getUsersByLocation();
                        },
                        error: function () {
                            $("#output").html("Error with ajax");
                        }
                    });

                }

            } else {
                alert("Geolocation is not supported by this browser.");
            }

            /*const elmnt = document.getElementById("worker");

             document.getElementById("pictures").style.height = elmnt.offsetHeight - (0.68 * elmnt.offsetHeight);
             document.getElementById("pictures").style.width = elmnt.offsetWidth;
             document.getElementById("pictures").style.marginTop = elmnt.offsetHeight - (0.32 * elmnt.offsetHeight);
             document.getElementById("pictures").style.marginBottom = "0px";*/
        }

        function getUsersByLocation() {
            $(document).ready(function () {
                $.ajax({
                    url: "../Controller/index.php",
                    type: 'post',
                    data: {action: "get_Workers_By_Location"},
                    success: function (data) {
                        //alert(data);
                        var allUsers = JSON.parse(data);
                        alert(allUsers);
                        var workers ="";
                        for (var i = 0; i < allUsers.length; i++) {
                            var profilePic = "../defaultPic/default.jpg";
                            var pic = allUsers[i][2];
                            if (pic != "" && pic != null) {
                                profilePic = "../profilePics/" + allUsers[i][2];
                            }
                            workers  =  workers + "<div id='worker' class=''>  <div id ='workerPictureDiv' class ='container-fluid' > <img id ='workerPicture' class ='container-fluid' src ='"+profilePic+"' alt='workers image' onclick='showProfilePic()'></div>    <div id='details'> <div id='workername'><a class='workername'>" +allUsers[i][1] + "</a></div> <div><a class='message' href='"+ allUsers[i][1]+"'> <svg xmlns='http://www.w3.org/2000/svg' id='message' class='' viewBox='0 0 16 16'> <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/> </svg> </a></div>   <p id='distanceAway'> "+ allUsers[i][3] +" km away</p></div> </div>";

                        }
                        document.getElementById("workers").innerHTML += workers;
                    },
                    error: function () {
                        alert("Error with ajax");
                    }
                });
            });

        }

     const entry = document.getElementById("search");
     var timeOutId = null;
     entry.addEventListener('input', function search() {
         const searchInput = entry.value.trim();
         if (searchInput != null && searchInput !== "") {
             clearTimeout(timeOutId);
             timeOutId = setTimeout(function () {
                 $.ajax({
                     url: "../Controller/index.php",
                     type: 'post',
                     data: {action: "search_Cat_Worker", "searchInput": searchInput},
                     success: function (data) {
                        // var allsearch = JSON.parse(data);
                         alert(data);
                     },
                     error: function () {
                         $("#output").html("Error with ajax");
                     }
                 });


             }, 500);
         }
         }
     );
    </script>
<?php
include 'footer.php';
?>