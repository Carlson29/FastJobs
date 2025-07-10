<?php
include 'header.php';
?>
    <style>


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

            max-height: 20vw;
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



        #suggestions {
            display: flex;
            flex-direction: column;
            height: 10vh;
            /*position: relative;
            display: inline-block;*/
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
            width: 50%;
        }

        #suggestion{
            border: 1px solid black;
            border-top: none;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            width: 20vw;
            height: 3vh;
            z-index: 99;


            padding: 10px;
            cursor: pointer;
            background-color: #fff;
overflow: visible;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        #suggestPic {
            border-radius: 50%;
            width:3vw;
            margin-left:2%;
            /* margin-top:vw;*/
            float:left;
            height:2vw;
        }
        #search-suggest{
            margin: auto;
            width: 20%;
            margin-top: 2vh;
        }
        #search{
            width: 21vw; ;
        }
        #suggestionName, #suggestionCategory{
         position: relative;
            bottom: 2vh;
        }

    </style>


    <body onload="getLocation()" id="main" >


    </div>
<div id="search-suggest">
    <div id="searchBar"><input placeholder="Search" id="search">
    <div id="suggestions">  </div>
    </div>
    </div>
</div>


    <div id="workers">

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


    </div>

    <div id="mainComponents">
        <div class="logoSection">
            <a href="../Controller/index.php?action=show_Profile">
                <img src="../logo/profile.png" class="logo" id="profileImage" alt="Profile">
                <p class="logoName">Profile</p>
            </a>
        </div>

        <div class="logoSection">
            <a href="../Controller/index.php?action=show_conversations">
                <img src="../logo/chat.png" class="logo" id="chatImage" alt="Chats">
                <p class="logoName">Chats</p>
            </a>
        </div>

        <div class="logoSection">
            <img src="../logo/feed.png" class="logo" id="feedImage" alt="Jobs Feed">
            <p class="logoName">Jobs Feed</p>
        </div>

        <div class="logoSection">
            <a href="../Controller/index.php?action=logout">
                <img src="../logo/logout.png" class="logo" id="logoutImage" alt="Logout">
                <p class="logoName">Logout</p>
            </a>
        </div>
    </div>

    </body>
    <script>
      // setInterval(getUsersByLocation, 2000);
       /* function openNav() {
            document.getElementById("mySidenav").style.width = "4vw";
            document.getElementById("main").style.marginLeft = "4vw";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginRight = "0";
        } */

        function getLocation() {
            //closeNav();
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
                        //alert(allUsers);
                        var workers ="";
                        for (var i = 0; i < allUsers.length; i++) {
                            var profilePic = "../defaultPic/default.jpg";
                            var pic = allUsers[i][2];
                            if (pic != "" && pic != null) {
                                profilePic = "../profilePics/" + allUsers[i][2];
                            }
                            workers  =  workers + "<div id='worker' class=''>  <div id ='workerPictureDiv' class ='container-fluid' > <img id ='workerPicture' class ='container-fluid' src ='"+profilePic+"' alt='workers image' onclick='showProfilePic()'></div>    <div id='details'> <div id='workername'><a class='workername'>" +allUsers[i][1] + "</a></div> <div><a class='message' href= '../Controller/index.php?action=show_conversations&otherUserId="+ allUsers[i][0]+"'> <svg xmlns='http://www.w3.org/2000/svg' id='message' class='' viewBox='0 0 16 16'> <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/> </svg> </a></div>   <p id='distanceAway'> "+ allUsers[i][3] +" away</p></div> </div>";

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
                         var data = JSON.parse(data);
                         var suggestions= "";
                         for(var i = 0; i < data.length; i++){
                             if(data[i][2]=="u"){
                                 var profilePic = "../defaultPic/default.jpg";
                                 if(data[i][3]!="" && data[i][3]!=null){
                                        profilePic = "../profilePics/" + data[i][3] ;
                                 }
                                 suggestions+= "<div id='suggestion'> <a href='../Controller/index.php?action=show_User_Profile&id=" + data[i][0] +"'> <img id='suggestPic' src='"+ profilePic+"'> <p id='suggestionName'>"+data[i][1] + "</p></div> </a>";
                             }
                             else if(data[i][2]=="c"){
                                suggestions+= "<div id='suggestion' onclick='getUserByCategoryId("+data[i][0]+")'><p id='suggestionCategory'>" +data[i][1] + "</p> </div>";
                             }
                             document.getElementById("suggestions").innerHTML = suggestions;
                         }
                     },
                     error: function () {
                         $("#output").html("Error with ajax");
                     }
                 });


             }, 500);
         }
         }
     );
     function getUserByCategoryId(categoryId) {
         $(document).ready(function () {
             $.ajax({
                 url: "../Controller/index.php",
                 type: 'post',
                 data: {action: "get_Workers_By_Category", categoryId: categoryId},
                 success: function (data) {
                    //alert(data);
                     var allUsers = JSON.parse(data);
                     //alert(allUsers);
                     var workers ="";
                     document.getElementById("workers").innerHTML ="";
                     for (var i = 0; i < allUsers.length; i++) {
                         var profilePic = "../defaultPic/default.jpg";
                         var pic = allUsers[i][2];
                         if (pic != "" && pic != null) {
                             profilePic = "../profilePics/" + allUsers[i][2];
                         }
                         workers  =  workers + "<div id='worker' class=''>  <div id ='workerPictureDiv' class ='container-fluid' > <img id ='workerPicture' class ='container-fluid' src ='"+profilePic+"' alt='workers image' onclick='showProfilePic()'></div>    <div id='details'> <div id='workername'><a class='workername'>" +allUsers[i][1] + "</a></div> <div><a class='message' href= '../Controller/index.php?action=show_conversations&otherUserId="+ allUsers[i][0]+"'> <svg xmlns='http://www.w3.org/2000/svg' id='message' class='' viewBox='0 0 16 16'> <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z'/> </svg> </a></div>   <p id='distanceAway'> "+ allUsers[i][3] +" km away</p></div> </div>";

                     }
                     document.getElementById("workers").innerHTML += workers;
                 },
                 error: function () {
                     alert("Error with ajax");
                 }
             });
         });
     }
      window.addEventListener('beforeunload', function(event) {
          $.ajax({
              url: "../Controller/index.php",
              type: 'post',
              data: {action: "clear_DateTime"},
              success: function (data) {

              },
              error: function () {
             alert("Error with ajax");
              }
          });
      });

      document.addEventListener('click', function(event) {
          let suggs= document.getElementById('suggestions');
          if(!suggs.contains(event.target)){
              suggs.innerHTML= "";
          }
      });
    </script>
<?php
include 'footer.php';
?>