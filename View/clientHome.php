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
        right: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        margin-left: 97vw;
    }

    .sidenav a {
        padding: 8px 15px 8px 10px;
        text-decoration: none;
        font-size: 16px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        font-size: 36px;
        margin-right:16vw;
        margin-left: 0px;
    }

</style>
<body onload="getLocation()">
<div id="sidebar">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <a href="../Controller/index.php?action=show_conversations" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
            </svg> chats </a>
        <a href=""class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            </svg>profile</a>
        <a href="" class="button">offers</a>
    </div>

</div>
<button><a href="../Controller/index.php?action=show_conversations" >hello</a></button>
</body>
    <script>

        function openNav() {
            document.getElementById("mySidenav").style.width = "4vw";
            document.getElementById("main").style.marginRight = "4vw";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition); // showPosition is the function that will handle the location data

                function showPosition(position) {

                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    //alert("Latitude: " + latitude +
                        "Longitude: " + longitude);
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {action: "store_Location","latitude": latitude, "longitude": longitude},
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

                    },
                    error: function () {
                        alert("Error with ajax");
                    }
                });
            });

        }

        </script>
<?php
include 'footer.php';
?>