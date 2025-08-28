<?php
include 'header.php';
?>
<style>
    #job{
        padding-top: 2vh;
        background-color: whitesmoke;
        border-radius: 1vw;
    }
    #feed{
        width:65vw;
        max-height: 80vh;
        overflow-y: scroll;
    }
    #jobMedia{
        max-width:67vw;
        max-height: 70vh;
        display: flex;
        flex-direction: row;
        overflow-x: scroll;
    }
    #jobPic{
        max-height: 50vh;
        max-width: 50vw;
        padding: 1vh;
        flex:1;
    }
    #profilePic{
        position: relative;
        left: 0.5vw;
        top: 0.25vh;
        height: 6vh;
        width: 3vw;
        border-radius: 2vw;
        padding-right: 1.5vw;
    }
    #jobHeader{
        display: flex;
        flex-direction: row;
    }
    #datePosted{
    position: relative;
        left: 45vw;
    }
    #userName{
        font-size: 20px ;
        font-weight: bold;
    }
    #aboutJob{
        padding-left: 1vw;
    }
    #feedContent{
        padding-top: 2vh;
        display: flex;
        flex-direction: row;
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
<body id="ibf">
<input type="file" id="feedInput" name="files[]" accept="image/*,video/*" multiple/>
<input type="text" id="aboutFeed">
<button onclick="uploadFeed()">Upload</button>
<br>
<div id="feedContent">
<div id="feed">
    <div id="job" >
        <div id="jobHeader">
            <img src="../logo/profile.png" id="profilePic" />
            <p id="userName"> Carlson</p>
            <p id="datePosted">10/10/2025</p>
        </div>
        <div id="jobMedia">
            <img id="jobPic" src="../logo/tradesgeneration.jpg" />
            <img id="jobPic" src="../logo/tradesgeneration.jpg" />
            <video id="jobPic" controls> <source src="../messageVideos/tryout.MOV" ></video>
        </div>
        <div>
            <p id="aboutJob"> Excited to start a new challenge</p>
        </div>
    </div>


</div>
    <div id="ibpSection">

    </div>
</div>

</body>
<script>
    var feedBody=  document.getElementById('feed');
    document.getElementById('feedInput').addEventListener('change', function () {
        if (this.files.length > 5) {
            alert('You can only upload up to 5 files.');
            this.value = ''; // Reset the input
        }
    });
    setInterval(getIbps, 2000);
    async function uploadFeed() {
        var feedImgs = document.getElementById('feedInput');
        var aboutFeed = document.getElementById('aboutFeed').value.trim();
        if (feedImgs.files.length > 0 || (aboutFeed !== '' && aboutFeed !== null)) {
            var formData = new FormData();
            formData.append('action', 'upload_feed');
            // Append each file individually
            alert(feedImgs.files.length);
            for (let i = 0; i < feedImgs.files.length; i++) {
                formData.append('files[]', feedImgs.files[i]);
            }
            formData.append('aboutFeed', aboutFeed);
            await fetch('../Controller/index.php', {
                method: "POST",
                body: formData
            }).then(response => response.json()) // parse JSON response
                .then(data => {
                    if (data.success) {
                        console.log('Upload successful:', data.message);
                        alert(data.message);
                    } else {
                        console.error('Upload failed:', data.message);
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Fetch error occurred');
                });

            //  feedImgs="";
            document.getElementById('feedInput').value = "";
            document.getElementById('aboutFeed').value = "";
            //alert(response.body);
        } else {
            alert("please enter feed details");
        }
    }

    function getFeed() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_Feed"},
                success: function (data) {
                    var allFeed = JSON.parse(data);
                    alert(allFeed);
                    //console.log(data);
                    var feed= "";
                    for (var i = 0; i < allFeed.length; i++) {
                        var profilePic="../logo/profile.png"
                        if(allFeed[i][2].trim()!="" && allFeed[i][2].trim()!=null){
                            profilePic="../profilePictures/"+ allFeed[i][2];
                        }

                        feed = feed + "<div id='job'><div id='jobHeader'> <img src='"+ profilePic +"' id='profilePic' /> <p id='userName'>" + allFeed[i][0] + "</p> <p id='datePosted'>" + allFeed[i][3] +"</p> </div> <div id='jobMedia'>";
                        for (var j = 0; j < allFeed[i][1].length; j++) {
                             if(allFeed[i][1][j][1]==1){
                                 feed = feed + "<img id='jobPic' src='../feedMedia/"+ allFeed[i][1][j][0] +"' >"
                             }
                             else if(allFeed[i][1][j][1]==2){
                                 feed = feed + "<video id='jobPic' > <source src='../feedMedia/"+ allFeed[i][1][j][0] +"'> </video>"
                             }
                        }
                        feed = feed +"</div>  <div> <p id='aboutJob'>"+ allFeed[i][5] +"</p> </div> </div>"
                    }
                    if(allFeed.length>0) {
                        document.getElementById('feed').innerHTML += feed;
                    }
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }

    function reloadFeed() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "reload_feed"},
                success: function (data) {
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
                            ibps = ibps + " <div id='ibp' onclick='openMessages(" + allIbps[i][6] + ")' > <div><img id='ibpPic' src='" + profilePic + "'></div>  <div id='ibpName'><p>" + allIbps[i][4] + "</p></div><p id='lastMessage'>" + allIbps[i][3] + "</p><div id='ibpTimeSent'><p>" + allIbps[i][1] + "</p></div> <div id=''><p id='ibpUnseenMessages'>" + allIbps[i][2] + "</p></div> </div>"
                        }
                        else{
                            ibps = ibps + " <div id='ibp' onclick='openMessages(" + allIbps[i][6] + ")' > <div><img id='ibpPic' src='" + profilePic + "'></div>  <div id='ibpName'><p>" + allIbps[i][4] + "</p></div><p id='lastMessage'>" + allIbps[i][3] + "</p><div id='ibpTimeSent'><p>" + allIbps[i][1] + "</p></div></div>"
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
    function openMessages(userId){
        window.location.href ="../Controller/index.php?action=show_conversations&otherUserId="+userId;
    }

  feedBody.addEventListener('scroll', (event) => {
     if(feedBody.scrollTop + feedBody.clientHeight >= feedBody.scrollHeight-1){
         getFeed();
     }
    });
    window.addEventListener('load', function () {
        reloadFeed();
        getFeed();
    });
</script>
<?php
include 'footer.php';
?>
