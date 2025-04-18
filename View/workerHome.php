<?php
include 'workerHeader.php';
?>
<style>
    body{
        display: flex;
        flex-direction: column;
    }
    #decorations{
        height: 57vh;
        width: 99vw;
    }
    #mainComponents{
       background-color: wheat;
        height: 25vh;
        width: 76vw;
        position: absolute;
        bottom:8vh;
        display: flex;
        flex-direction: row;
        padding-left: 23vw;
    }
    body{
        background-color: whitesmoke;
    }
    .logo{
        width: 10vw;
        height:15vh;
    }
    #logoSection{
        position: relative;
        top: 3vh;
        margin-right: 2vw;
        margin-left: 2vw;
    }
    #logoName{
        position: relative;
        top: -2.5vh;
        margin-left: 3vw;
    }
    #decorationImage{

        /*  width: 100%;
          height: 54vh;
          display: block;
          object-fit: cover;  or contain depending on what you want */
        height: 54vh;
        width: 90vw;
       position: relative;
     /* padding-left: 4.5vw;
padding-top: 2.5vh;*/
    }
    #decorationImageSection{
        height: 54vh;
        width: 90vw;
        position: relative;
        padding-left: 4.5vw;
        padding-top: 2.5vh;
    }

</style>
<body >
<div id="decorations">
   <div id="decorationImageSection">
       <img id="decorationImage" src="" >
   </div>
</div>
<div id="mainComponents" >

    <div id="logoSection">
        <a href="../Controller/index.php?action=show_Profile">
<img src="../logo/profile.png" class="logo" id="profileImage">
        <p id="logoName"> Profile</p>
        </a>
    </div>

    <div id="logoSection">
        <a href="../Controller/index.php?action=show_conversations">
        <img src="../logo/chat.png" class="logo" id="chatImage">
        <p id="logoName"> chats</p>
        </a>
    </div>
    <div id="logoSection">
        <img src="../logo/feed.png" class="logo" id="feedImage">
        <p id="logoName">Jobs feed </p>
    </div>
    <div id="logoSection">
        <a href="../Controller/index.php?action=logout">
        <img src="../logo/logout.png" class="logo" id="logoutImage">
        <p id="logoName"> Logout</p>
        </a>
    </div>
</div>

</body>

<script>
let pictures =[];
//start from 1 to make sure the slide show continues
var index = 1;

setInterval(changePicture,5000);

function changePicture(){
    document.getElementById("decorationImage").src = "../tradesPeoplePictures/"+pictures[index];
    if(index >=pictures.length-1){
        index = 0;
    }
    else{
        index++;
    }

}

   function getPictures(){
    $(document).ready(function () {
        $.ajax({
            url: "../Controller/index.php",
            type: 'post',
            data: {action: "get_Worker_Pictures"},
            success: function (data) {
               pictures= JSON.parse(data);
               document.getElementById("decorationImage").src = "../tradesPeoplePictures/"+ pictures[0];

            },
            error: function () {
                alert("Error with ajax");
            }
        });
    });
}

    window.addEventListener('load',function(){
            getPictures();
        }
    );
</script>

<?php
include 'workerFooter.php';
?>

